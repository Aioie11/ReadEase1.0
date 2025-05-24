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

        return view('admin.AdminDashboard', compact('totalStudents', 'totalTests', 'topListeners'));
    }
} 