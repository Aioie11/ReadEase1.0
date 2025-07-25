<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\ReadingAssessment;
use App\Models\Student;
use App\Models\ReadingMaterial;

// Initialize Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$student = Student::first();
echo "Student ID: " . $student->student_number . "\n";

$assessments = ReadingAssessment::where('student_id', $student->student_number)
    ->where('language', 'english')
    ->get();

echo "Total assessments: " . $assessments->count() . "\n";
foreach ($assessments as $assessment) {
    echo "Assessment ID: " . $assessment->id . ", Material ID: " . $assessment->reading_material_id . ", Language: " . $assessment->language . "\n";
}

// Check current published material
$publishedMaterial = ReadingMaterial::where('grade_level', $student->grade_level)
    ->where('subject', 'english')
    ->where('is_published', true)
    ->first();

if ($publishedMaterial) {
    echo "Published Material ID: " . $publishedMaterial->id . ", Title: " . $publishedMaterial->title . "\n";
    
    // Check if student has assessment for this specific material
    $hasAssessment = ReadingAssessment::where('student_id', $student->student_number)
        ->where('language', 'english')
        ->where('reading_material_id', $publishedMaterial->id)
        ->exists();
    
    echo "Has assessment for published material: " . ($hasAssessment ? 'YES' : 'NO') . "\n";
} else {
    echo "No published material found\n";
}
