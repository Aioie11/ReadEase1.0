<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\ReadingMaterial;
use App\Models\ReadingAssessment;
use App\Models\Student;
use App\Models\User;
use App\Models\StudentAnswerEnglish;

// Initialize Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "🔍 Simple Reports Logic Test\n";
echo "============================\n\n";

$student = Student::first();
$user = User::where('userId', $student->student_number)->first();

echo "Student: {$student->first_name} {$student->last_name} (Grade: {$user->grade})\n\n";

// Test the logic from StudentDashboardController
echo "Testing data retrieval logic:\n";

// Get currently published reading materials for this student's grade
$currentEnglishMaterial = ReadingMaterial::where('grade_level', $user->grade)
    ->where('subject', 'english')
    ->where('is_published', true)
    ->first();

echo "Current published English material: ";
if ($currentEnglishMaterial) {
    echo "{$currentEnglishMaterial->title} (ID: {$currentEnglishMaterial->id})\n";
} else {
    echo "None\n";
}

// Get latest activities for CURRENT published materials (for graphs)
$latestEnglishActivity = null;
if ($currentEnglishMaterial) {
    $latestEnglishActivity = StudentAnswerEnglish::where('student_id', $user->userId)
        ->where('reading_material_id', $currentEnglishMaterial->id)
        ->with('readingMaterial.questions')
        ->latest()
        ->first();
}

echo "Latest activity for current material: ";
if ($latestEnglishActivity) {
    echo "Found (Score: {$latestEnglishActivity->score})\n";
} else {
    echo "None (graphs will be empty)\n";
}

// Get ALL historical activities (for Answer Results table)
$allEnglishActivities = StudentAnswerEnglish::where('student_id', $user->userId)
    ->with('readingMaterial.questions')
    ->orderBy('created_at', 'desc')
    ->get();

echo "All historical activities: {$allEnglishActivities->count()}\n";
foreach ($allEnglishActivities as $activity) {
    $materialTitle = $activity->readingMaterial ? $activity->readingMaterial->title : 'Unknown Material';
    echo "  - {$materialTitle} (Score: {$activity->score}, Date: {$activity->created_at})\n";
}

// Get reading assessments for CURRENT published materials (for graphs)
$latestEnglishReading = null;
if ($currentEnglishMaterial) {
    $latestEnglishReading = ReadingAssessment::where('student_id', $user->userId)
        ->where('language', 'english')
        ->where('reading_material_id', $currentEnglishMaterial->id)
        ->latest('assessment_date')
        ->first();
}

echo "Latest reading assessment for current material: ";
if ($latestEnglishReading) {
    echo "Found (Speed: {$latestEnglishReading->reading_speed} WPM)\n";
} else {
    echo "None (graphs will be empty)\n";
}

// Get all reading assessments for this student (for Reading Results table)
$allReadingAssessments = ReadingAssessment::where('student_id', $user->userId)
    ->with('readingMaterial')
    ->orderBy('assessment_date', 'desc')
    ->get();

echo "All historical reading assessments: {$allReadingAssessments->count()}\n";
foreach ($allReadingAssessments as $assessment) {
    $materialTitle = $assessment->readingMaterial ? $assessment->readingMaterial->title : 'Unknown Material';
    echo "  - {$materialTitle} ({$assessment->language}, Speed: {$assessment->reading_speed} WPM, Date: {$assessment->assessment_date})\n";
}

echo "\n✅ Logic Test Summary:\n";
echo "- Graphs will show data only for currently published material\n";
echo "- Historical tables will show all past activities and assessments\n";
echo "- When new material is published without student activity, graphs reset but history remains\n";

echo "\nTest completed.\n";
