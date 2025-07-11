<?php

require_once 'vendor/autoload.php';

// Initialize Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\StudentAnswerEnglish;
use App\Models\StudentAnswerTagalog;
use App\Models\ReadingAssessment;
use App\Models\Student;
use App\Models\User;

echo "🔍 Checking for Orphaned Test Records\n";
echo "=" . str_repeat("=", 40) . "\n\n";

// Get all existing student IDs
$existingStudentIds = collect();

// Get student IDs from users table (active accounts)
$userStudentIds = User::where('role', 'student')->pluck('userId');
$existingStudentIds = $existingStudentIds->merge($userStudentIds);

// Get student numbers from students table
$studentNumbers = Student::pluck('student_number');
$existingStudentIds = $existingStudentIds->merge($studentNumbers);

// Remove duplicates
$existingStudentIds = $existingStudentIds->unique();

echo "Existing Student IDs: " . $existingStudentIds->implode(', ') . "\n\n";

// Check English tests
echo "📝 English Test Records:\n";
$englishTests = StudentAnswerEnglish::all();
foreach ($englishTests as $test) {
    $isOrphaned = !$existingStudentIds->contains($test->student_id);
    $status = $isOrphaned ? "❌ ORPHANED" : "✅ Valid";
    echo "  ID: {$test->id}, Student: {$test->student_id}, Score: {$test->score}, Date: {$test->created_at} - {$status}\n";
}

// Check Filipino tests
echo "\n🇵🇭 Filipino Test Records:\n";
$filipinoTests = StudentAnswerTagalog::all();
if ($filipinoTests->count() == 0) {
    echo "  No Filipino test records found.\n";
} else {
    foreach ($filipinoTests as $test) {
        $isOrphaned = !$existingStudentIds->contains($test->student_id);
        $status = $isOrphaned ? "❌ ORPHANED" : "✅ Valid";
        echo "  ID: {$test->id}, Student: {$test->student_id}, Score: {$test->score}, Date: {$test->created_at} - {$status}\n";
    }
}

// Check Reading assessments
echo "\n📖 Reading Assessment Records:\n";
$readingTests = ReadingAssessment::all();
foreach ($readingTests as $test) {
    $isOrphaned = !$existingStudentIds->contains($test->student_id);
    $status = $isOrphaned ? "❌ ORPHANED" : "✅ Valid";
    echo "  ID: {$test->id}, Student: {$test->student_id}, Name: {$test->student_name}, Date: {$test->created_at} - {$status}\n";
}

// Count orphaned records
$orphanedEnglish = StudentAnswerEnglish::whereNotIn('student_id', $existingStudentIds)->count();
$orphanedFilipino = StudentAnswerTagalog::whereNotIn('student_id', $existingStudentIds)->count();
$orphanedReading = ReadingAssessment::whereNotIn('student_id', $existingStudentIds)->count();

echo "\n📊 Summary:\n";
echo "Orphaned English tests: {$orphanedEnglish}\n";
echo "Orphaned Filipino tests: {$orphanedFilipino}\n";
echo "Orphaned Reading assessments: {$orphanedReading}\n";
echo "Total orphaned records: " . ($orphanedEnglish + $orphanedFilipino + $orphanedReading) . "\n";
