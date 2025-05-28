<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReadingAssessment;
use Carbon\Carbon;

class ReadingAssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            'Maria Garcia',
            'Juan Santos',
            'Ana Reyes',
            'Carlos Mendoza',
            'Sofia Cruz',
            'Miguel Torres',
            'Elena Rodriguez',
            'Diego Morales',
            'Carmen Flores',
            'Luis Herrera',
            'Isabella Jimenez',
            'Fernando Castro',
            'Lucia Vargas',
            'Roberto Silva',
            'Valentina Ruiz',
            'Alejandro Gutierrez',
            'Camila Ortega',
            'Sebastian Ramos',
            'Natalia Delgado',
            'Mateo Vega'
        ];

        $sections = ['narra', 'lawaan', 'dao', 'mahugani'];
        $languages = ['english', 'filipino'];
        $grades = ['7', '8', '9', '10'];

        foreach ($grades as $grade) {
            foreach ($sections as $section) {
                foreach ($languages as $language) {
                    // Create 5-6 students per section per language per grade
                    $studentsInSection = array_slice($students, 0, rand(5, 6));

                    foreach ($studentsInSection as $student) {
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
                            'student_name' => $student,
                            'reading_time' => $readingTimeSeconds,
                            'miscues' => $miscues,
                            'total_words' => $totalWords,
                            'correct_answers' => $correctAnswers,
                            'total_questions' => $totalQuestions,
                            'comprehension' => $comprehension,
                            'correct_reading' => $correctReading,
                            'reading_speed' => $readingSpeed,
                            'section' => $section,
                            'language' => $language,
                            'grade' => $grade,
                            'assessment_date' => Carbon::now()->subDays(rand(1, 30))
                        ]);
                    }
                }
            }
        }
    }
}
