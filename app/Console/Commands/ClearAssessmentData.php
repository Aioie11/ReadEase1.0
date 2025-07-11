<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ReadingAssessment;
use App\Models\StudentAnswerEnglish;
use App\Models\StudentAnswerTagalog;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ClearAssessmentData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assessment:clear {--orphaned : Only clear orphaned records from deleted students}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all student assessment and comprehension data, or only orphaned records';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->option('orphaned')) {
            return $this->clearOrphanedRecords();
        }

        $this->info('Clearing all student assessment data...');

        try {
            // Disable foreign key checks temporarily
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            // Clear teacher feedback first (has foreign key to reading_assessments)
            if (Schema::hasTable('teacher_feedback')) {
                $feedbackCount = DB::table('teacher_feedback')->count();
                DB::table('teacher_feedback')->delete();
                $this->info("✅ Cleared {$feedbackCount} teacher feedback records");
            }

            // Clear reading assessments
            $readingCount = ReadingAssessment::count();
            ReadingAssessment::query()->delete();
            $this->info("✅ Cleared {$readingCount} reading assessment records");

            // Clear English comprehension answers
            $englishCount = StudentAnswerEnglish::count();
            StudentAnswerEnglish::query()->delete();
            $this->info("✅ Cleared {$englishCount} English comprehension answer records");

            // Clear Filipino comprehension answers
            $filipinoCount = StudentAnswerTagalog::count();
            StudentAnswerTagalog::query()->delete();
            $this->info("✅ Cleared {$filipinoCount} Filipino comprehension answer records");

            // Clear student reading levels
            if (Schema::hasTable('student_reading_levels')) {
                $levelCount = DB::table('student_reading_levels')->count();
                DB::table('student_reading_levels')->delete();
                $this->info("✅ Cleared {$levelCount} student reading level records");
            }

            // Clear student readings if exists
            if (Schema::hasTable('student_readings')) {
                $studentReadingCount = DB::table('student_readings')->count();
                DB::table('student_readings')->delete();
                $this->info("✅ Cleared {$studentReadingCount} student reading records");
            }

            // Re-enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $this->info('');
            $this->info('🎉 All assessment data cleared successfully!');
            $this->info('📚 Students are now reset to having no reading or comprehension data.');
            $this->info('🧪 Ready for testing from a clean state!');

        } catch (\Exception $e) {
            $this->error('❌ Error clearing assessment data: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }

    /**
     * Clear only orphaned records from deleted students
     */
    private function clearOrphanedRecords()
    {
        $this->info('Clearing orphaned test records from deleted students...');

        try {
            // Get all existing student IDs from both users and students tables
            $existingStudentIds = collect();

            // Get student IDs from users table (active accounts)
            $userStudentIds = DB::table('users')
                ->where('role', 'student')
                ->pluck('userId');
            $existingStudentIds = $existingStudentIds->merge($userStudentIds);

            // Get student numbers from students table
            $studentNumbers = DB::table('students')
                ->pluck('student_number');
            $existingStudentIds = $existingStudentIds->merge($studentNumbers);

            // Remove duplicates
            $existingStudentIds = $existingStudentIds->unique();

            $this->info("Found {$existingStudentIds->count()} existing students");

            // Disable foreign key checks temporarily
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            $totalDeleted = 0;

            // Clear orphaned teacher feedback
            if (Schema::hasTable('teacher_feedback')) {
                $orphanedFeedback = DB::table('teacher_feedback')
                    ->whereNotIn('student_id', $existingStudentIds)
                    ->count();

                if ($orphanedFeedback > 0) {
                    DB::table('teacher_feedback')
                        ->whereNotIn('student_id', $existingStudentIds)
                        ->delete();
                    $this->info("✅ Cleared {$orphanedFeedback} orphaned teacher feedback records");
                    $totalDeleted += $orphanedFeedback;
                }
            }

            // Clear orphaned reading assessments
            $orphanedReading = ReadingAssessment::whereNotIn('student_id', $existingStudentIds)->count();
            if ($orphanedReading > 0) {
                ReadingAssessment::whereNotIn('student_id', $existingStudentIds)->delete();
                $this->info("✅ Cleared {$orphanedReading} orphaned reading assessment records");
                $totalDeleted += $orphanedReading;
            }

            // Clear orphaned English comprehension answers
            $orphanedEnglish = StudentAnswerEnglish::whereNotIn('student_id', $existingStudentIds)->count();
            if ($orphanedEnglish > 0) {
                StudentAnswerEnglish::whereNotIn('student_id', $existingStudentIds)->delete();
                $this->info("✅ Cleared {$orphanedEnglish} orphaned English comprehension records");
                $totalDeleted += $orphanedEnglish;
            }

            // Clear orphaned Filipino comprehension answers
            $orphanedFilipino = StudentAnswerTagalog::whereNotIn('student_id', $existingStudentIds)->count();
            if ($orphanedFilipino > 0) {
                StudentAnswerTagalog::whereNotIn('student_id', $existingStudentIds)->delete();
                $this->info("✅ Cleared {$orphanedFilipino} orphaned Filipino comprehension records");
                $totalDeleted += $orphanedFilipino;
            }

            // Clear orphaned student reading levels
            if (Schema::hasTable('student_reading_levels')) {
                $orphanedLevels = DB::table('student_reading_levels')
                    ->whereNotIn('student_id', $existingStudentIds)
                    ->count();

                if ($orphanedLevels > 0) {
                    DB::table('student_reading_levels')
                        ->whereNotIn('student_id', $existingStudentIds)
                        ->delete();
                    $this->info("✅ Cleared {$orphanedLevels} orphaned student reading level records");
                    $totalDeleted += $orphanedLevels;
                }
            }

            // Clear orphaned student readings
            if (Schema::hasTable('student_readings')) {
                $orphanedReadings = DB::table('student_readings')
                    ->whereNotIn('student_id', $existingStudentIds)
                    ->count();

                if ($orphanedReadings > 0) {
                    DB::table('student_readings')
                        ->whereNotIn('student_id', $existingStudentIds)
                        ->delete();
                    $this->info("✅ Cleared {$orphanedReadings} orphaned student reading records");
                    $totalDeleted += $orphanedReadings;
                }
            }

            // Re-enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $this->info('');
            if ($totalDeleted > 0) {
                $this->info("🎉 Cleared {$totalDeleted} total orphaned records successfully!");
                $this->info('📚 Database is now clean of orphaned test data.');
            } else {
                $this->info('✨ No orphaned records found. Database is already clean!');
            }

        } catch (\Exception $e) {
            $this->error('❌ Error clearing orphaned records: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
