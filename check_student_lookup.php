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

echo "🔍 Checking Student Lookup Logic\n";
echo "=" . str_repeat("=", 40) . "\n\n";

// Check all test records and see how they would appear in admin dashboard
echo "📝 English Test Records:\n";
$englishTests = StudentAnswerEnglish::all();
foreach ($englishTests as $test) {
    echo "  Test ID: {$test->id}, Student ID: {$test->student_id}\n";
    
    // Simulate the admin dashboard lookup logic
    $studentName = 'Unknown Student';
    $student = null;
    try {
        $student = Student::where('student_number', $test->student_id)->first();
        if ($student) {
            $middleInitial = $student->middle_name ? ' ' . substr($student->middle_name, 0, 1) . '.' : '';
            $studentName = $student->last_name . ', ' . $student->first_name . $middleInitial;
        }
    } catch (\Exception $e) {
        // Keep default name if lookup fails
    }
    
    echo "    → Dashboard would show: '{$studentName}'\n";
    echo "    → Student found in students table: " . ($student ? 'YES' : 'NO') . "\n";
    
    // Check if student exists in users table
    $user = User::where('userId', $test->student_id)->first();
    echo "    → Student found in users table: " . ($user ? 'YES' : 'NO') . "\n";
    echo "\n";
}

echo "📖 Reading Assessment Records:\n";
$readingTests = ReadingAssessment::all();
foreach ($readingTests as $test) {
    echo "  Test ID: {$test->id}, Student ID: {$test->student_id}, Stored Name: {$test->student_name}\n";
    
    // Simulate the admin dashboard lookup logic
    $studentName = $test->student_name; // fallback to stored name
    try {
        $student = Student::where('student_number', $test->student_id)->first();
        if ($student) {
            $middleInitial = $student->middle_name ? ' ' . substr($student->middle_name, 0, 1) . '.' : '';
            $studentName = $student->last_name . ', ' . $student->first_name . $middleInitial;
        }
    } catch (\Exception $e) {
        // Keep stored name if lookup fails
    }
    
    echo "    → Dashboard would show: '{$studentName}'\n";
    echo "    → Student found in students table: " . ($student ? 'YES' : 'NO') . "\n";
    
    // Check if student exists in users table
    $user = User::where('userId', $test->student_id)->first();
    echo "    → Student found in users table: " . ($user ? 'YES' : 'NO') . "\n";
    echo "\n";
}

// Show all students in both tables
echo "👥 All Students in Database:\n";
echo "Students table:\n";
$students = Student::all();
foreach ($students as $student) {
    echo "  - {$student->student_number}: {$student->last_name}, {$student->first_name}\n";
}

echo "\nUsers table (students only):\n";
$users = User::where('role', 'student')->get();
foreach ($users as $user) {
    echo "  - {$user->userId}: {$user->name}\n";
}

echo "\n📊 Summary:\n";
echo "Total students in 'students' table: " . Student::count() . "\n";
echo "Total student users in 'users' table: " . User::where('role', 'student')->count() . "\n";
echo "Total English tests: " . StudentAnswerEnglish::count() . "\n";
echo "Total Reading assessments: " . ReadingAssessment::count() . "\n";
