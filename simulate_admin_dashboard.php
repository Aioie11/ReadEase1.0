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

echo "🖥️  Simulating Admin Dashboard Recent Tests\n";
echo "=" . str_repeat("=", 50) . "\n\n";

// Simulate the exact logic from AdminController::dashboard()
$recentTests = collect();

// Get English tests
$englishTests = StudentAnswerEnglish::latest()
    ->take(10)
    ->get()
    ->map(function ($test) {
        // Get student name directly from student table in consistent format
        $studentName = 'Unknown Student';
        $student = null;
        try {
            $student = Student::where('student_number', $test->student_id)->first();
            if ($student) {
                // Use consistent format: Last, First M.I.
                $middleInitial = $student->middle_name ? ' ' . substr($student->middle_name, 0, 1) . '.' : '';
                $studentName = $student->last_name . ', ' . $student->first_name . $middleInitial;
            }
        } catch (\Exception $e) {
            // Keep default name if lookup fails
        }

        // Calculate percentage
        $percentage = $test->total_questions > 0 ? round(($test->score / $test->total_questions) * 100) : 0;

        // Determine assessment level based on percentage
        $assessmentLevel = 'Frustration';
        if ($percentage >= 80) {
            $assessmentLevel = 'Independent';
        } elseif ($percentage >= 60) {
            $assessmentLevel = 'Instructional';
        }

        // All tests that appear in the table are considered completed
        $status = 'Completed';

        return (object)[
            'id' => $test->id,
            'student_id' => $test->student_id,
            'student_name' => $studentName,
            'test_type' => 'English Comprehension Test',
            'score' => $percentage,
            'created_at' => $test->created_at,
            'status' => $status,
            'assessment_level' => $assessmentLevel
        ];
    });

// Get Filipino tests
$tagalogTests = StudentAnswerTagalog::latest()
    ->take(10)
    ->get()
    ->map(function ($test) {
        // Get student name directly from student table in consistent format
        $studentName = 'Unknown Student';
        $student = null;
        try {
            $student = Student::where('student_number', $test->student_id)->first();
            if ($student) {
                // Use consistent format: Last, First M.I.
                $middleInitial = $student->middle_name ? ' ' . substr($student->middle_name, 0, 1) . '.' : '';
                $studentName = $student->last_name . ', ' . $student->first_name . $middleInitial;
            }
        } catch (\Exception $e) {
            // Keep default name if lookup fails
        }

        // Calculate percentage
        $percentage = $test->total_questions > 0 ? round(($test->score / $test->total_questions) * 100) : 0;

        // Determine assessment level based on percentage
        $assessmentLevel = 'Frustration';
        if ($percentage >= 80) {
            $assessmentLevel = 'Independent';
        } elseif ($percentage >= 60) {
            $assessmentLevel = 'Instructional';
        }

        // All tests that appear in the table are considered completed
        $status = 'Completed';

        return (object)[
            'id' => $test->id,
            'student_id' => $test->student_id,
            'student_name' => $studentName,
            'test_type' => 'Filipino Comprehension Test',
            'score' => $percentage,
            'created_at' => $test->created_at,
            'status' => $status,
            'assessment_level' => $assessmentLevel
        ];
    });

// Get Reading assessments
$readingTests = ReadingAssessment::latest()
    ->take(10)
    ->get()
    ->map(function ($test) {
        // Determine the specific test type based on language
        $testType = 'Reading Assessment';
        if ($test->language) {
            $testType = ucfirst($test->language) . ' Reading Assessment';
        }

        // Get student name from Student table in consistent format
        $studentName = $test->student_name; // fallback to stored name
        try {
            $student = Student::where('student_number', $test->student_id)->first();
            if ($student) {
                // Use consistent format: Last, First M.I.
                $middleInitial = $student->middle_name ? ' ' . substr($student->middle_name, 0, 1) . '.' : '';
                $studentName = $student->last_name . ', ' . $student->first_name . $middleInitial;
            }
        } catch (\Exception $e) {
            // Keep stored name if lookup fails
        }

        // Calculate percentage for reading assessment
        $percentage = 0;
        if ($test->total_questions > 0) {
            $percentage = round(($test->correct_answers / $test->total_questions) * 100);
        }

        // Determine assessment level
        $assessmentLevel = $test->overall_reading_level ?? 'Frustration';

        // All tests that appear in the table are considered completed
        $status = 'Completed';

        return (object)[
            'id' => $test->id,
            'student_id' => $test->student_id,
            'student_name' => $studentName,
            'test_type' => $testType,
            'score' => $percentage,
            'created_at' => $test->created_at,
            'status' => $status,
            'assessment_level' => $assessmentLevel
        ];
    });

// Combine all tests and remove duplicates by keeping most recent per student per test type
$allTests = $recentTests->concat($englishTests)
    ->concat($tagalogTests)
    ->concat($readingTests);

// Group by student_id and test_type, keep only the most recent for each combination
$uniqueTests = $allTests->groupBy(function($test) {
    return $test->student_id . '_' . $test->test_type;
})->map(function($group) {
    return $group->sortByDesc('created_at')->first();
})->values();

// Sort by date and take the 10 most recent
$recentTests = $uniqueTests->sortByDesc('created_at')->take(10);

echo "📋 Recent Tests (as they would appear in admin dashboard):\n";
echo "=" . str_repeat("=", 80) . "\n";
printf("%-12s %-25s %-30s %-8s %-15s %-10s\n", 
    "Date", "Student", "Test Type", "Score", "Level", "Status");
echo str_repeat("-", 80) . "\n";

foreach ($recentTests as $test) {
    printf("%-12s %-25s %-30s %-8s %-15s %-10s\n",
        $test->created_at->format('M d, Y'),
        substr($test->student_name, 0, 24),
        substr($test->test_type, 0, 29),
        $test->score . '%',
        $test->assessment_level,
        $test->status
    );
}

if ($recentTests->count() == 0) {
    echo "No recent tests found.\n";
}

echo "\n📊 Dashboard Stats:\n";
$totalStudents = Student::count();
$totalTests = StudentAnswerEnglish::count() + StudentAnswerTagalog::count() + ReadingAssessment::count();
$topListeners = Student::whereHas('englishAnswers')
    ->orWhereHas('tagalogAnswers')
    ->orWhereHas('readingAssessments')
    ->count();

echo "Total Students: {$totalStudents}\n";
echo "Total Tests: {$totalTests}\n";
echo "Top Listeners: {$topListeners}\n";
