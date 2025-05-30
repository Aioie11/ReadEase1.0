<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentAnswerEnglish;
use App\Models\StudentAnswerTagalog;
use App\Models\ReadingMaterial;
use App\Models\ReadingQuestion;

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
        if ($latestEnglishActivity && $totalEnglishQuestions > 0) {
            $latestEnglishScore = $latestEnglishActivity->score;
            $englishPercent = round(($latestEnglishScore / $totalEnglishQuestions) * 100);
            $totalPercent += $englishPercent;
            $completedCount++;
        }

        // Calculate Filipino percentage if available
        if ($latestFilipinoActivity && $totalFilipinoQuestions > 0) {
            $latestFilipinoScore = $latestFilipinoActivity->score;
            $filipinoPercent = round(($latestFilipinoScore / $totalFilipinoQuestions) * 100);
            $totalPercent += $filipinoPercent;
            $completedCount++;
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

        return view('student.stud-dash', compact(
            'user',
            'latestEnglishActivity',
            'latestFilipinoActivity',
            'latestEnglishScore',
            'totalEnglishQuestions',
            'latestFilipinoScore',
            'totalFilipinoQuestions',
            'averageScore',
            'completionPercentage'
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

        return view('student.stud-reports', compact('user'));
    }
} 