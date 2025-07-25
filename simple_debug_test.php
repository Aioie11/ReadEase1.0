<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\ReadingMaterial;
use App\Models\ReadingAssessment;
use App\Models\Student;
use App\Models\User;

// Initialize Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "🔍 Simple Debug Test\n";
echo "===================\n\n";

$student = Student::first();
$user = User::where('userId', $student->student_number)->first();

echo "Student: {$student->first_name} {$student->last_name} (Grade: {$student->grade_level})\n";
echo "User: {$user->userId} (Grade: {$user->grade})\n\n";

// Create a test material
$material = ReadingMaterial::create([
    'title' => 'Debug Test Material',
    'content' => 'Test content',
    'grade_level' => $user->grade,
    'subject' => 'filipino',
    'is_published' => true,
    'published_at' => now()
]);

echo "Created material: {$material->title} (ID: {$material->id}, Grade: {$material->grade_level})\n\n";

// Create a reading assessment
$assessment = ReadingAssessment::create([
    'student_id' => $student->student_number,
    'student_name' => $student->first_name . ' ' . $student->last_name,
    'reading_material_id' => $material->id,
    'reading_time' => 120.5,
    'miscues' => 2,
    'total_words' => 150,
    'correct_answers' => 4,
    'total_questions' => 5,
    'comprehension' => 80,
    'correct_reading' => 148,
    'reading_speed' => 75,
    'section' => $student->section,
    'language' => 'filipino',
    'grade' => $user->grade,
    'assessment_date' => now(),
    'overall_reading_level' => 'Instructional'
]);

echo "Created assessment: ID {$assessment->id}\n";
echo "  - Student ID: {$assessment->student_id}\n";
echo "  - Language: {$assessment->language}\n";
echo "  - Material ID: {$assessment->reading_material_id}\n";
echo "  - Grade: {$assessment->grade}\n\n";

// Now test the teacher controller logic
echo "Testing teacher controller logic:\n";

// Get currently published reading materials for this student's grade
$publishedFilipinoMaterial = ReadingMaterial::where('grade_level', $student->grade_level)
    ->where('subject', 'filipino')
    ->where('is_published', true)
    ->first();

if ($publishedFilipinoMaterial) {
    echo "Found published Filipino material: {$publishedFilipinoMaterial->title} (ID: {$publishedFilipinoMaterial->id})\n";
    
    $filipinoAssessment = ReadingAssessment::where('student_id', $student->student_number)
        ->where('language', 'filipino')
        ->where('reading_material_id', $publishedFilipinoMaterial->id)
        ->latest('assessment_date')
        ->first();
    
    if ($filipinoAssessment) {
        echo "Found matching assessment: ID {$filipinoAssessment->id}\n";
    } else {
        echo "No matching assessment found\n";
        
        // Debug: check all assessments for this student
        $allAssessments = ReadingAssessment::where('student_id', $student->student_number)
            ->where('language', 'filipino')
            ->get();
        
        echo "All Filipino assessments for this student:\n";
        foreach ($allAssessments as $a) {
            echo "  - ID: {$a->id}, Material ID: {$a->reading_material_id}, Grade: {$a->grade}\n";
        }
    }
} else {
    echo "No published Filipino material found for grade {$student->grade_level}\n";
}

// Cleanup
$assessment->delete();
$material->delete();

echo "\nTest completed.\n";
