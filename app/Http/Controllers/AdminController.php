<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentAnswerEnglish;
use App\Models\StudentAnswerTagalog;
use App\Models\ReadingAssessment;
use App\Models\User;
use App\Services\ReadingLevelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // Get recent English tests (one per student)
        $englishTests = StudentAnswerEnglish::select('*')
            ->whereIn('id', function($query) {
                $query->select(\DB::raw('MAX(id)'))
                    ->from('student_answer_english')
                    ->groupBy('student_id');
            })
            ->latest()
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

                // Calculate percentage from score and total questions
                $totalQuestions = count($test->answers ?? []);
                $percentage = $totalQuestions > 0 ? round(($test->score / $totalQuestions) * 100) : 0;

                // Calculate assessment level based on comprehension score
                $assessmentLevel = 'Frustration';
                if ($percentage >= 80) {
                    $assessmentLevel = 'Independent';
                } elseif ($percentage >= 59) {
                    $assessmentLevel = 'Instructional';
                }

                return (object)[
                    'id' => $test->id,
                    'student_id' => $test->student_id,
                    'student_name' => $studentName,
                    'test_type' => 'English Comprehension Test',
                    'score' => $percentage,
                    'created_at' => $test->created_at,
                    'status' => 'Completed',
                    'assessment_level' => $assessmentLevel
                ];
            });

        // Get recent Tagalog tests (one per student)
        $tagalogTests = StudentAnswerTagalog::select('*')
            ->whereIn('id', function($query) {
                $query->select(\DB::raw('MAX(id)'))
                    ->from('student_answer_tagalog')
                    ->groupBy('student_id');
            })
            ->latest()
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

                // Calculate percentage from score and total questions
                $totalQuestions = count($test->answers ?? []);
                $percentage = $totalQuestions > 0 ? round(($test->score / $totalQuestions) * 100) : 0;

                // Calculate assessment level based on comprehension score
                $assessmentLevel = 'Frustration';
                if ($percentage >= 80) {
                    $assessmentLevel = 'Independent';
                } elseif ($percentage >= 59) {
                    $assessmentLevel = 'Instructional';
                }

                return (object)[
                    'id' => $test->id,
                    'student_id' => $test->student_id,
                    'student_name' => $studentName,
                    'test_type' => 'Filipino Comprehension Test',
                    'score' => $percentage,
                    'created_at' => $test->created_at,
                    'status' => 'Completed',
                    'assessment_level' => $assessmentLevel
                ];
            });

        // Get recent reading assessments (one per student per language)
        $readingTests = ReadingAssessment::select('*')
            ->whereIn('id', function($query) {
                $query->select(\DB::raw('MAX(id)'))
                    ->from('reading_assessments')
                    ->groupBy('student_id', 'language');
            })
            ->latest()
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

                // Calculate percentage for reading assessments
                // Use correct_reading field if available, otherwise calculate from words and miscues
                $percentage = 0;
                if ($test->correct_reading !== null) {
                    $percentage = $test->correct_reading;
                } else {
                    // Calculate percentage from correct words vs total words
                    $correctWords = $test->total_words - $test->miscues;
                    $percentage = $test->total_words > 0 ? round(($correctWords / $test->total_words) * 100) : 0;
                }

                // Calculate assessment level using ReadingLevelService
                $readingLevelService = new ReadingLevelService();
                $assessmentLevel = $readingLevelService->calculateReadingLevel(
                    $test->correct_reading ?? $percentage,
                    $test->comprehension ?? 0
                );

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