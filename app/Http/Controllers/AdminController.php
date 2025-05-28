<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentAnswerEnglish;
use App\Models\StudentAnswerTagalog;
use App\Models\ReadingAssessment;
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
        $englishTests = StudentAnswerEnglish::with('student')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($test) {
                return (object)[
                    'id' => $test->id,
                    'student_name' => $test->student->first_name . ' ' . $test->student->last_name,
                    'test_type' => 'English Test',
                    'score' => $test->score,
                    'created_at' => $test->created_at,
                    'status' => 'Complete'
                ];
            });

        // Get recent Tagalog tests
        $tagalogTests = StudentAnswerTagalog::with('student')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($test) {
                return (object)[
                    'id' => $test->id,
                    'student_name' => $test->student->first_name . ' ' . $test->student->last_name,
                    'test_type' => 'Tagalog Test',
                    'score' => $test->score,
                    'created_at' => $test->created_at,
                    'status' => 'Complete'
                ];
            });

        // Get recent reading assessments
        $readingTests = ReadingAssessment::latest()
            ->take(5)
            ->get()
            ->map(function ($test) {
                return (object)[
                    'id' => $test->id,
                    'student_name' => $test->student_name,
                    'test_type' => 'Reading Assessment',
                    'score' => round(($test->reading_speed / 200) * 100), // Convert reading speed to percentage
                    'created_at' => $test->created_at,
                    'status' => 'Complete'
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