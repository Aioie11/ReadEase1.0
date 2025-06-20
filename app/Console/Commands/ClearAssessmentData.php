<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ReadingAssessment;
use App\Models\StudentAnswerEnglish;
use App\Models\StudentAnswerTagalog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ClearAssessmentData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assessment:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all student assessment and comprehension data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
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
}
