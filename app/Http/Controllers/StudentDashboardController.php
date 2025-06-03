<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentAnswerEnglish;
use App\Models\StudentAnswerTagalog;
use App\Models\ReadingMaterial;
use App\Models\ReadingQuestion;
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

        // Get total questions from reading materials
        $totalEnglishQuestions = ReadingQuestion::whereHas('readingMaterial', function($query) {
            $query->where('subject', 'english')
                  ->where('is_published', true);
        })->count();

        $totalFilipinoQuestions = ReadingQuestion::whereHas('readingMaterial', function($query) {
            $query->where('subject', 'filipino')
                  ->where('is_published', true);
        })->count();

        // Calculate individual percentages and scores
        $englishPercent = 0;
        $filipinoPercent = 0;
        $completedCount = 0;
        $totalPercent = 0;
        $latestEnglishScore = 0;
        $latestFilipinoScore = 0;

        // Calculate English percentage if available
        if ($latestEnglishActivity) {
            $latestEnglishScore = $latestEnglishActivity->score;
            $totalEnglishQuestions = count($latestEnglishActivity->answers ?? []);
            if ($totalEnglishQuestions > 0) {
                $englishPercent = round(($latestEnglishScore / $totalEnglishQuestions) * 100);
                $totalPercent += $englishPercent;
                $completedCount++;
            }
        }

        // Calculate Filipino percentage if available
        if ($latestFilipinoActivity) {
            $latestFilipinoScore = $latestFilipinoActivity->score;
            $totalFilipinoQuestions = count($latestFilipinoActivity->answers ?? []);
            if ($totalFilipinoQuestions > 0) {
                $filipinoPercent = round(($latestFilipinoScore / $totalFilipinoQuestions) * 100);
                $totalPercent += $filipinoPercent;
                $completedCount++;
            }
        }

        // Calculate average performance
        $averageScore = $completedCount > 0 ? round($totalPercent / $completedCount) : 0;

        // Calculate completion percentage based on completed activities
        // Total possible activities: 4 (English Reading, English Answering, Filipino Reading, Filipino Answering)
        $completedActivities = 0;
        if ($latestEnglishActivity) $completedActivities++;
        if ($latestFilipinoActivity) $completedActivities++;
        // Reading activities are not yet connected, so they count as 0
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
            'latestEnglishScore',
            'totalEnglishQuestions',
            'latestFilipinoScore',
            'totalFilipinoQuestions',
            'averageScore',
            'completionPercentage',
            'averageTimeFormatted'
        ));
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

        // Get latest English test result for this student
        $latestEnglishActivity = StudentAnswerEnglish::where('student_id', $user->userId)
            ->latest()
            ->first();

        // Get latest Filipino test result for this student
        $latestFilipinoActivity = StudentAnswerTagalog::where('student_id', $user->userId)
            ->latest()
            ->first();

        // Get all English answers for this student
        $englishAnswers = StudentAnswerEnglish::where('student_id', $user->userId)
            ->orderBy('created_at', 'desc')
            ->get();

        // Get all Filipino answers for this student
        $filipinoAnswers = StudentAnswerTagalog::where('student_id', $user->userId)
            ->orderBy('created_at', 'desc')
            ->get();

        // Set session variables for graphs
        if ($latestEnglishActivity) {
            session([
                'english_reading_time' => $latestEnglishActivity->reading_time ?? 0,
                'english_reading_speed' => $latestEnglishActivity->reading_speed ?? 0,
                'english_score' => $latestEnglishActivity->score ?? 0,
                'english_total_questions' => count($latestEnglishActivity->answers ?? [])
            ]);
        } else {
            session([
                'english_reading_time' => 0,
                'english_reading_speed' => 0,
                'english_score' => 0,
                'english_total_questions' => 0
            ]);
        }

        if ($latestFilipinoActivity) {
            session([
                'filipino_reading_time' => $latestFilipinoActivity->reading_time ?? 0,
                'filipino_reading_speed' => $latestFilipinoActivity->reading_speed ?? 0,
                'filipino_score' => $latestFilipinoActivity->score ?? 0,
                'filipino_total_questions' => count($latestFilipinoActivity->answers ?? [])
            ]);
        } else {
            session([
                'filipino_reading_time' => 0,
                'filipino_reading_speed' => 0,
                'filipino_score' => 0,
                'filipino_total_questions' => 0
            ]);
        }

        return view('student.stud-reports', compact(
            'user',
            'latestEnglishActivity',
            'latestFilipinoActivity',
            'englishAnswers',
            'filipinoAnswers'
        ));
    }
} 