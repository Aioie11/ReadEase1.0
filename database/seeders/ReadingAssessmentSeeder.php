<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReadingAssessment;
use App\Models\Student;
use Carbon\Carbon;

class ReadingAssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all students from the database
        $students = Student::all();

        if ($students->isEmpty()) {
            $this->command->info('No students found in database. Please run StudentSeeder first.');
            return;
        }

        $languages = ['english', 'filipino'];

        foreach ($students as $student) {
            foreach ($languages as $language) {
                // Create 1-2 assessments per student per language
                $assessmentCount = rand(1, 2);

                for ($i = 0; $i < $assessmentCount; $i++) {
                    // Generate realistic assessment data
                    $totalWords = rand(120, 200);
                    $miscues = rand(0, 15);
                    $correctReading = round(((($totalWords - $miscues) / $totalWords) * 100), 0);

                    $totalQuestions = rand(8, 12);
                    $correctAnswers = rand(floor($totalQuestions * 0.4), $totalQuestions);
                    $comprehension = round(($correctAnswers / $totalQuestions) * 100, 0);

                    $readingTimeSeconds = rand(60, 300); // 1-5 minutes
                    $readingSpeed = round(($totalWords / ($readingTimeSeconds / 60)), 0);

                    ReadingAssessment::create([
                        'student_id' => $student->student_number, // Link to actual student
                        'student_name' => $student->first_name . ' ' . $student->last_name,
                        'reading_time' => $readingTimeSeconds,
                        'miscues' => $miscues,
                        'total_words' => $totalWords,
                        'correct_answers' => $correctAnswers,
                        'total_questions' => $totalQuestions,
                        'comprehension' => $comprehension,
                        'correct_reading' => $correctReading,
                        'reading_speed' => $readingSpeed,
                        'section' => $student->section,
                        'language' => $language,
                        'grade' => (string) $student->grade_level,
                        'assessment_date' => Carbon::now()->subDays(rand(1, 30))
                    ]);
                }
            }
        }

        $this->command->info('Created reading assessments for ' . $students->count() . ' students.');
    }
}
