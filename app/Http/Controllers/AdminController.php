<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentAnswerEnglish;
use App\Models\StudentAnswerTagalog;
use App\Models\ReadingAssessment;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get total number of students
        $totalStudents = Student::count();

        // Get total number of completed tests
        $totalTests = StudentAnswerEnglish::count() + StudentAnswerTagalog::count() + ReadingAssessment::count();

        // Get top listeners (students who have completed at least one test)
        $topListeners = Student::whereHas('englishAnswers')
            ->orWhereHas('tagalogAnswers')
            ->orWhereHas('readingAssessments')
            ->count();



        // Get recent tests from all sources
        $recentTests = collect();

        // Get recent English tests
        $englishTests = StudentAnswerEnglish::latest()
            ->take(5)
            ->get()
            ->map(function ($test) {
                // Get student name directly from student table
                $studentName = 'Unknown Student';
                try {
                    $student = Student::where('student_number', $test->student_id)->first();
                    if ($student) {
                        $studentName = $student->first_name . ' ' . $student->last_name;
                    }
                } catch (\Exception $e) {
                    // Keep default name if lookup fails
                }

                return (object)[
                    'id' => $test->id,
                    'student_name' => $studentName,
                    'test_type' => 'English Comprehension Test',
                    'score' => $test->score,
                    'created_at' => $test->created_at,
                    'status' => 'Completed'
                ];
            });

        // Get recent Tagalog tests
        $tagalogTests = StudentAnswerTagalog::latest()
            ->take(5)
            ->get()
            ->map(function ($test) {
                // Get student name directly from student table
                $studentName = 'Unknown Student';
                try {
                    $student = Student::where('student_number', $test->student_id)->first();
                    if ($student) {
                        $studentName = $student->first_name . ' ' . $student->last_name;
                    }
                } catch (\Exception $e) {
                    // Keep default name if lookup fails
                }

                return (object)[
                    'id' => $test->id,
                    'student_name' => $studentName,
                    'test_type' => 'Filipino Comprehension Test',
                    'score' => $test->score,
                    'created_at' => $test->created_at,
                    'status' => 'Completed'
                ];
            });

        // Get recent reading assessments
        $readingTests = ReadingAssessment::latest()
            ->take(5)
            ->get()
            ->map(function ($test) {
                // Determine the specific test type based on language
                $testType = 'Reading Assessment';
                if ($test->language) {
                    $testType = ucfirst($test->language) . ' Reading Assessment';
                }

                // Calculate a more comprehensive score based on reading performance
                $score = 0;
                if ($test->comprehension > 0) {
                    // If comprehension test is completed, use comprehension score
                    $score = $test->comprehension;
                } else {
                    // If only reading assessment is done, use reading accuracy
                    $score = $test->correct_reading ?? round(($test->reading_speed / 200) * 100);
                }

                // Determine status based on completion
                $status = 'Complete';
                if ($test->comprehension == 0 && $test->correct_answers == 0) {
                    $status = 'Reading Only';
                } elseif ($test->comprehension > 0) {
                    $status = 'Fully Complete';
                }

                return (object)[
                    'id' => $test->id,
                    'student_name' => $test->student_name,
                    'test_type' => $testType,
                    'score' => round($score),
                    'created_at' => $test->created_at,
                    'status' => $status
                ];
            });

        // Combine all tests and sort by date
        $recentTests = $recentTests->concat($englishTests)
            ->concat($tagalogTests)
            ->concat($readingTests)
            ->sortByDesc('created_at')
            ->take(5);

        return view('admin.AdminDashboard', compact('totalStudents', 'totalTests', 'topListeners', 'recentTests'));
    }

    public function deleteTest($id)
    {
        // Try to find and delete the test from each model
        $deleted = false;

        // Try English tests
        $englishTest = StudentAnswerEnglish::find($id);
        if ($englishTest) {
            $englishTest->delete();
            $deleted = true;
        }

        // Try Tagalog tests
        $tagalogTest = StudentAnswerTagalog::find($id);
        if ($tagalogTest) {
            $tagalogTest->delete();
            $deleted = true;
        }

        // Try Reading assessments
        $readingTest = ReadingAssessment::find($id);
        if ($readingTest) {
            $readingTest->delete();
            $deleted = true;
        }

        if ($deleted) {
            return redirect()->back()->with('success', 'Test deleted successfully');
        }

        return redirect()->back()->with('error', 'Test not found');
    }
} 