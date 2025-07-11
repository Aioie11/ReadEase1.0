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

echo "📊 Database Record Counts\n";
echo "=" . str_repeat("=", 30) . "\n\n";

echo "Students in 'students' table: " . Student::count() . "\n";
echo "Student users in 'users' table: " . User::where('role', 'student')->count() . "\n";
echo "English tests: " . StudentAnswerEnglish::count() . "\n";
echo "Filipino tests: " . StudentAnswerTagalog::count() . "\n";
echo "Reading assessments: " . ReadingAssessment::count() . "\n";

$totalTests = StudentAnswerEnglish::count() + StudentAnswerTagalog::count() + ReadingAssessment::count();
echo "Total tests: " . $totalTests . "\n\n";

// Check what the admin dashboard would show
echo "📈 Admin Dashboard Calculation:\n";
$totalStudents = Student::count();
$totalTests = StudentAnswerEnglish::count() + StudentAnswerTagalog::count() + ReadingAssessment::count();
$topListeners = Student::whereHas('englishAnswers')
    ->orWhereHas('tagalogAnswers')
    ->orWhereHas('readingAssessments')
    ->count();

echo "Total Students: {$totalStudents}\n";
echo "Total Tests: {$totalTests}\n";
echo "Top Listeners: {$topListeners}\n";
