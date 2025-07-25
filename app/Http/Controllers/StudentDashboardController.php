<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentAnswerEnglish;
use App\Models\StudentAnswerTagalog;
use App\Models\ReadingMaterial;
use App\Models\ReadingQuestion;
use App\Models\TeacherFeedback;
use Carbon\Carbon;

class StudentDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(\App\Http\Middleware\StudentMiddleware::class);
    }

    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        // Verify session data matches authenticated user
        if ($user->id !== session('user_id') || $user->role !== session('user_role')) {
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        // Get latest English test result
        $latestEnglishActivity = StudentAnswerEnglish::where('student_id', $user->userId)
            ->latest()
            ->first();

        // Get latest Filipino test result
        $latestFilipinoActivity = StudentAnswerTagalog::where('student_id', $user->userId)
            ->latest()
            ->first();

        // Get latest English reading assessment
        $latestEnglishReading = \App\Models\ReadingAssessment::where('student_id', $user->userId)
            ->where('language', 'english')
            ->latest('assessment_date')
            ->first();

        // Get latest Filipino reading assessment
        $latestFilipinoReading = \App\Models\ReadingAssessment::where('student_id', $user->userId)
            ->where('language', 'filipino')
            ->latest('assessment_date')
            ->first();

        // Get total questions from reading materials
        $totalEnglishQuestions = ReadingQuestion::whereHas('readingMaterial', function($query) {
            $query->where('subject', 'english')
                  ->where('is_published', true);
        })->count();

        $totalFilipinoQuestions = ReadingQuestion::whereHas('readingMaterial', function($query) {
            $query->where('subject', 'filipino')
                  ->where('is_published', true);
        })->count();

        // Calculate individual percentages and scores for all 4 activities
        $completedCount = 0;
        $totalPercent = 0;
        $latestEnglishScore = 0;
        $latestFilipinoScore = 0;

        // 1. English Reading Assessment (teacher's submitted percentage)
        if ($latestEnglishReading && $latestEnglishReading->correct_reading !== null) {
            $englishReadingPercent = $latestEnglishReading->correct_reading;
            $totalPercent += $englishReadingPercent;
            $completedCount++;
        }

        // 2. Filipino Reading Assessment (teacher's submitted percentage)
        if ($latestFilipinoReading && $latestFilipinoReading->correct_reading !== null) {
            $filipinoReadingPercent = $latestFilipinoReading->correct_reading;
            $totalPercent += $filipinoReadingPercent;
            $completedCount++;
        }

        // 3. English Comprehension (correct answers / total questions)
        if ($latestEnglishActivity) {
            $latestEnglishScore = $latestEnglishActivity->score;
            $totalEnglishQuestions = count($latestEnglishActivity->answers ?? []);
            if ($totalEnglishQuestions > 0) {
                $englishComprehensionPercent = round(($latestEnglishScore / $totalEnglishQuestions) * 100);
                $totalPercent += $englishComprehensionPercent;
                $completedCount++;
            }
        }

        // 4. Filipino Comprehension (correct answers / total questions)
        if ($latestFilipinoActivity) {
            $latestFilipinoScore = $latestFilipinoActivity->score;
            $totalFilipinoQuestions = count($latestFilipinoActivity->answers ?? []);
            if ($totalFilipinoQuestions > 0) {
                $filipinoComprehensionPercent = round(($latestFilipinoScore / $totalFilipinoQuestions) * 100);
                $totalPercent += $filipinoComprehensionPercent;
                $completedCount++;
            }
        }

        // Calculate average performance based on completed activities
        $averageScore = $completedCount > 0 ? round($totalPercent / $completedCount) : 0;

        // Log calculation details for debugging
        \Log::info('📊 Student Dashboard Performance Calculation', [
            'student_id' => $user->userId,
            'completed_activities' => $completedCount,
            'total_percent_sum' => $totalPercent,
            'average_score' => $averageScore,
            'completion_percentage' => round(($completedCount / 4) * 100),
            'activities' => [
                'english_reading' => $latestEnglishReading ? [
                    'status' => 'completed',
                    'teacher_submitted_percentage' => $latestEnglishReading->correct_reading,
                    'assessment_date' => $latestEnglishReading->assessment_date
                ] : 'pending',
                'filipino_reading' => $latestFilipinoReading ? [
                    'status' => 'completed',
                    'teacher_submitted_percentage' => $latestFilipinoReading->correct_reading,
                    'assessment_date' => $latestFilipinoReading->assessment_date
                ] : 'pending',
                'english_comprehension' => $latestEnglishActivity ? [
                    'status' => 'completed',
                    'score' => $latestEnglishActivity->score,
                    'total_questions' => count($latestEnglishActivity->answers ?? [])
                ] : 'pending',
                'filipino_comprehension' => $latestFilipinoActivity ? [
                    'status' => 'completed',
                    'score' => $latestFilipinoActivity->score,
                    'total_questions' => count($latestFilipinoActivity->answers ?? [])
                ] : 'pending'
            ]
        ]);

        // Calculate completion percentage based on completed activities
        // Total possible activities: 4 (English Reading, English Answering, Filipino Reading, Filipino Answering)
        $completedActivities = 0;
        if ($latestEnglishActivity) $completedActivities++;
        if ($latestFilipinoActivity) $completedActivities++;
        if ($latestEnglishReading) $completedActivities++;
        if ($latestFilipinoReading) $completedActivities++;
        $completionPercentage = round(($completedActivities / 4) * 100);

        // Calculate total time spent
        $totalTimeSpent = 0;
        $completedTests = 0;

        // Calculate time for English answering test
        if ($latestEnglishActivity) {
            $startTime = Carbon::parse($latestEnglishActivity->start_time);
            $endTime = Carbon::parse($latestEnglishActivity->end_time);
            $totalTimeSpent += $endTime->diffInSeconds($startTime);
            $completedTests++;
        }

        // Calculate time for Filipino answering test
        if ($latestFilipinoActivity) {
            $startTime = Carbon::parse($latestFilipinoActivity->start_time);
            $endTime = Carbon::parse($latestFilipinoActivity->end_time);
            $totalTimeSpent += $endTime->diffInSeconds($startTime);
            $completedTests++;
        }

        // Calculate average time for both tests
        $averageTimeSpent = $completedTests > 0 ? round($totalTimeSpent / $completedTests) : 0;

        // Format time for display
        $formatTime = function($seconds) {
            if ($seconds < 60) {
                return $seconds . ' seconds';
            } else {
                $minutes = floor($seconds / 60);
                $remainingSeconds = $seconds % 60;
                return $minutes . ' min ' . $remainingSeconds . ' sec';
            }
        };

        $averageTimeFormatted = $formatTime($averageTimeSpent);

        return view('student.stud-dash', compact(
            'user',
            'latestEnglishActivity',
            'latestFilipinoActivity',
            'latestEnglishReading',
            'latestFilipinoReading',
            'latestEnglishScore',
            'totalEnglishQuestions',
            'latestFilipinoScore',
            'totalFilipinoQuestions',
            'averageScore',
            'completionPercentage',
            'averageTimeFormatted'
        ));
    }

    /**
     * Check for reading assessment updates for auto-refresh functionality
     */
    public function checkReadingUpdates($studentId)
    {
        try {
            // Check if there are any recent reading assessments (within last 2 minutes)
            $recentEnglishReading = \App\Models\ReadingAssessment::where('student_id', $studentId)
                ->where('language', 'english')
                ->where('updated_at', '>=', now()->subMinutes(2))
                ->exists();

            $recentFilipinoReading = \App\Models\ReadingAssessment::where('student_id', $studentId)
                ->where('language', 'filipino')
                ->where('updated_at', '>=', now()->subMinutes(2))
                ->exists();

            // Check cache flags set by assessment controllers
            $englishUpdateFlag = cache()->get("assessment_completed_{$studentId}_english", false);
            $filipinoUpdateFlag = cache()->get("assessment_completed_{$studentId}_filipino", false);

            $hasUpdates = $recentEnglishReading || $recentFilipinoReading || $englishUpdateFlag || $filipinoUpdateFlag;

            // Clear cache flags if they exist
            if ($englishUpdateFlag) {
                cache()->forget("assessment_completed_{$studentId}_english");
            }
            if ($filipinoUpdateFlag) {
                cache()->forget("assessment_completed_{$studentId}_filipino");
            }

            return response()->json([
                'hasUpdates' => $hasUpdates,
                'timestamp' => now()->toISOString()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'hasUpdates' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function reports()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        // Verify session data matches authenticated user
        if ($user->id !== session('user_id') || $user->role !== session('user_role')) {
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }

        // Get currently published reading materials for this student's grade
        $currentEnglishMaterial = ReadingMaterial::where('grade_level', $user->grade)
            ->where('subject', 'english')
            ->where('is_published', true)
            ->first();

        $currentFilipinoMaterial = ReadingMaterial::where('grade_level', $user->grade)
            ->where('subject', 'filipino')
            ->where('is_published', true)
            ->first();

        // Get latest activities for CURRENT published materials (for graphs)
        $latestEnglishActivity = null;
        if ($currentEnglishMaterial) {
            $latestEnglishActivity = StudentAnswerEnglish::where('student_id', $user->userId)
                ->where('reading_material_id', $currentEnglishMaterial->id)
                ->with('readingMaterial.questions')
                ->latest()
                ->first();
        }

        $latestFilipinoActivity = null;
        if ($currentFilipinoMaterial) {
            $latestFilipinoActivity = StudentAnswerTagalog::where('student_id', $user->userId)
                ->where('reading_material_id', $currentFilipinoMaterial->id)
                ->with('readingMaterial.questions')
                ->latest()
                ->first();
        }

        // Get ALL historical activities (for Answer Results table)
        $allEnglishActivities = StudentAnswerEnglish::where('student_id', $user->userId)
            ->with('readingMaterial.questions')
            ->orderBy('created_at', 'desc')
            ->get();

        $allFilipinoActivities = StudentAnswerTagalog::where('student_id', $user->userId)
            ->with('readingMaterial.questions')
            ->orderBy('created_at', 'desc')
            ->get();

        // Get reading assessments for CURRENT published materials (for graphs)
        $latestEnglishReading = null;
        if ($currentEnglishMaterial) {
            $latestEnglishReading = \App\Models\ReadingAssessment::where('student_id', $user->userId)
                ->where('language', 'english')
                ->where('reading_material_id', $currentEnglishMaterial->id)
                ->latest('assessment_date')
                ->first();
        }

        $latestFilipinoReading = null;
        if ($currentFilipinoMaterial) {
            $latestFilipinoReading = \App\Models\ReadingAssessment::where('student_id', $user->userId)
                ->where('language', 'filipino')
                ->where('reading_material_id', $currentFilipinoMaterial->id)
                ->latest('assessment_date')
                ->first();
        }

        // Get all reading assessments for this student (for Reading Results table)
        // Include the reading material relationship to get the correct title
        $allReadingAssessments = \App\Models\ReadingAssessment::where('student_id', $user->userId)
            ->with('readingMaterial')
            ->orderBy('assessment_date', 'desc')
            ->get();

        // Get all English answers for this student
        $englishAnswers = StudentAnswerEnglish::where('student_id', $user->userId)
            ->orderBy('created_at', 'desc')
            ->get();

        // Get all Filipino answers for this student
        $filipinoAnswers = StudentAnswerTagalog::where('student_id', $user->userId)
            ->orderBy('created_at', 'desc')
            ->get();

        // Get teacher feedback for this student
        $englishFeedback = TeacherFeedback::with('readingMaterial')
            ->where('student_id', $user->userId)
            ->where('language', 'english')
            ->where('is_sent', true)
            ->orderBy('sent_at', 'desc')
            ->get();

        $filipinoFeedback = TeacherFeedback::with('readingMaterial')
            ->where('student_id', $user->userId)
            ->where('language', 'filipino')
            ->where('is_sent', true)
            ->orderBy('sent_at', 'desc')
            ->get();

        // Mark feedback as read when student views reports
        TeacherFeedback::where('student_id', $user->userId)
            ->where('is_sent', true)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now()
            ]);

        // Calculate total questions from reading material or use stored value as fallback
        $englishTotalQuestions = 0;
        if ($latestEnglishActivity) {
            if ($latestEnglishActivity->readingMaterial) {
                $englishTotalQuestions = $latestEnglishActivity->readingMaterial->questions()->count();
            } else {
                // Fallback to stored total_questions field
                $englishTotalQuestions = $latestEnglishActivity->total_questions ?? 0;
            }
        }

        $filipinoTotalQuestions = 0;
        if ($latestFilipinoActivity) {
            if ($latestFilipinoActivity->readingMaterial) {
                $filipinoTotalQuestions = $latestFilipinoActivity->readingMaterial->questions()->count();
            } else {
                // Fallback to stored total_questions field
                $filipinoTotalQuestions = $latestFilipinoActivity->total_questions ?? 0;
            }
        }

        // Set session variables for graphs - combine student activity and teacher assessment data
        session([
            // English comprehension data (from student activity)
            'english_score' => $latestEnglishActivity ? $latestEnglishActivity->score ?? 0 : 0,
            'english_total_questions' => $englishTotalQuestions,

            // English reading data (from teacher assessment)
            'english_reading_time' => $latestEnglishReading ? $latestEnglishReading->reading_time ?? 0 : 0,
            'english_reading_speed' => $latestEnglishReading ? $latestEnglishReading->reading_speed ?? 0 : 0,
            'english_total_words' => $latestEnglishReading ? $latestEnglishReading->total_words ?? 0 : 0,
            'english_miscues' => $latestEnglishReading ? $latestEnglishReading->miscues ?? 0 : 0,
            'english_correct_reading' => $latestEnglishReading ? $latestEnglishReading->correct_reading ?? 0 : 0
        ]);

        session([
            // Filipino comprehension data (from student activity)
            'filipino_score' => $latestFilipinoActivity ? $latestFilipinoActivity->score ?? 0 : 0,
            'filipino_total_questions' => $filipinoTotalQuestions,

            // Filipino reading data (from teacher assessment)
            'filipino_reading_time' => $latestFilipinoReading ? $latestFilipinoReading->reading_time ?? 0 : 0,
            'filipino_reading_speed' => $latestFilipinoReading ? $latestFilipinoReading->reading_speed ?? 0 : 0,
            'filipino_total_words' => $latestFilipinoReading ? $latestFilipinoReading->total_words ?? 0 : 0,
            'filipino_miscues' => $latestFilipinoReading ? $latestFilipinoReading->miscues ?? 0 : 0,
            'filipino_correct_reading' => $latestFilipinoReading ? $latestFilipinoReading->correct_reading ?? 0 : 0
        ]);

        return view('student.stud-reports', compact(
            'user',
            'latestEnglishActivity',
            'latestFilipinoActivity',
            'latestEnglishReading',
            'latestFilipinoReading',
            'allReadingAssessments',
            'englishAnswers',
            'filipinoAnswers',
            'allEnglishActivities',
            'allFilipinoActivities',
            'englishFeedback',
            'filipinoFeedback',
            'englishTotalQuestions',
            'filipinoTotalQuestions'
        ));
    }

    public function getUnreadFeedbackCount(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['count' => 0]);
        }

        $count = TeacherFeedback::where('student_id', $user->userId)
            ->where('is_sent', true)
            ->where('is_read', false)
            ->count();

        return response()->json(['count' => $count]);
    }
}