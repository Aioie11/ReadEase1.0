<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\ReadingMaterial;
use App\Models\ReadingAssessment;
use App\Models\Student;
use App\Models\User;
use App\Models\ReadingQuestion;
use App\Models\StudentAnswerTagalog;

// Initialize Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "🔍 Debugging Filipino Assessment Creation\n";
echo "========================================\n\n";

$student = Student::first();
$user = User::where('userId', $student->student_number)->first();

echo "Student: {$student->first_name} {$student->last_name} (ID: {$student->student_number})\n";
echo "User Grade: {$user->grade}\n\n";

// Check for published Filipino materials
$publishedMaterial = ReadingMaterial::where('grade_level', $user->grade)
    ->where('subject', 'filipino')
    ->where('is_published', true)
    ->first();

if ($publishedMaterial) {
    echo "Published Filipino Material: {$publishedMaterial->title} (ID: {$publishedMaterial->id})\n";
} else {
    echo "No published Filipino material found for grade {$user->grade}\n";
}

// Check existing reading assessments
$existingAssessments = ReadingAssessment::where('student_id', $student->student_number)
    ->where('language', 'filipino')
    ->get();

echo "Existing Filipino assessments: {$existingAssessments->count()}\n";
foreach ($existingAssessments as $assessment) {
    echo "  - ID: {$assessment->id}, Material ID: {$assessment->reading_material_id}, Date: {$assessment->assessment_date}\n";
}

// Check student answers
$studentAnswers = StudentAnswerTagalog::where('student_id', $student->student_number)->get();
echo "Student Filipino answers: {$studentAnswers->count()}\n";
foreach ($studentAnswers as $answer) {
    echo "  - ID: {$answer->id}, Material ID: {$answer->reading_material_id}, Score: {$answer->score}\n";
}

echo "\n";

// Check if there are any recent log entries
echo "Recent log entries (last 10 lines):\n";
$logFile = storage_path('logs/laravel.log');
if (file_exists($logFile)) {
    $lines = file($logFile);
    $recentLines = array_slice($lines, -10);
    foreach ($recentLines as $line) {
        if (strpos($line, 'Filipino') !== false || strpos($line, 'reading assessment') !== false) {
            echo $line;
        }
    }
} else {
    echo "No log file found\n";
}
