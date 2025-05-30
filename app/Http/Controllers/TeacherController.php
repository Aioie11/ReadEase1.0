<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\ReadingMaterial;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(\App\Http\Middleware\TeacherMiddleware::class);
    }

    public function dashboard()
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

        // Get all students
        $students = Student::all();

        return view('teacher.dashboard', compact('user', 'students'));
    }

    public function view(Request $request)
    {
        $student = Student::where('student_number', $request->student)->firstOrFail();
        return view('teacher.view', compact('student'));
    }

    public function passage(Request $request)
    {
        $grade = $request->get('grade', 'grade7');
        $section = $request->get('section', 'narra');
        $language = $request->get('language', 'english');

        // Get all students
        $students = Student::all();

        // Get published reading material for this grade and language
        $readingMaterial = ReadingMaterial::where('grade_level', str_replace('grade', '', $grade))
            ->where('subject', $language)
            ->where('is_published', true)
            ->latest('published_at')
            ->first();

        return view('teacher.passage', compact('grade', 'section', 'language', 'students', 'readingMaterial'));
    }

    public function studentManagement(Request $request)
    {
        $grade = $request->get('grade');
        $section = $request->get('section');

        $query = Student::query();

        if ($grade && $grade !== 'All Grades') {
            $query->where('grade_level', str_replace('Grade ', '', $grade));
        }

        if ($section && $section !== 'All Sections') {
            $query->where('section', str_replace('Section ', '', $section));
        }

        $students = $query->get();

        return view('teacher.studentManagement', compact('students'));
    }
} 