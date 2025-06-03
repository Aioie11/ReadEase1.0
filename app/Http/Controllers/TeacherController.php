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

        // Get published reading material for this grade and language with comprehension questions
        $readingMaterial = ReadingMaterial::with('comprehensionQuestions')
            ->where('grade_level', str_replace('grade', '', $grade))
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

    public function getStudentsBySection(Request $request)
    {
        $grade = $request->input('grade');
        $section = $request->input('section');

        $students = Student::where('grade_level', $grade)
            ->where('section', $section)
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get()
            ->map(function ($student) {
                return [
                    'id' => $student->student_number,
                    'name' => $student->last_name . ', ' . $student->first_name
                ];
            });

        return response()->json($students);
    }

    public function getStudentComprehensionDetails($studentId, $language = 'english')
    {
        try {
            // Find the student
            $student = Student::where('student_number', $studentId)->first();

            if (!$student) {
                return response()->json([
                    'success' => false,
                    'message' => 'Student not found'
                ], 404);
            }

            // Get the latest comprehension assessment for this student and language
            $answerModel = $language === 'english' ?
                \App\Models\StudentAnswerEnglish::class :
                \App\Models\StudentAnswerTagalog::class;

            $latestAnswer = $answerModel::where('student_id', $studentId)
                ->latest('created_at')
                ->first();

            if (!$latestAnswer) {
                return response()->json([
                    'success' => false,
                    'message' => 'No comprehension assessment found for this student'
                ], 404);
            }

            // Get the reading material and questions
            $readingMaterial = \App\Models\ReadingMaterial::where('subject', $language)
                ->where('is_published', true)
                ->latest('published_at')
                ->first();

            if (!$readingMaterial) {
                return response()->json([
                    'success' => false,
                    'message' => 'No reading material found'
                ], 404);
            }

            $questions = $readingMaterial->questions()->orderBy('id')->get();

            // Process answers and compare with correct answers
            $answerDetails = [];
            foreach ($questions as $index => $question) {
                $questionNumber = $index + 1;
                $studentAnswer = $latestAnswer->{'c' . $questionNumber} ?? '';
                $correctAnswer = $question->correct_answer;
                $isCorrect = trim(strtolower($studentAnswer)) === trim(strtolower($correctAnswer));

                $answerDetails[] = [
                    'question_number' => $questionNumber,
                    'question' => $question->question,
                    'student_answer' => $studentAnswer,
                    'correct_answer' => $correctAnswer,
                    'is_correct' => $isCorrect,
                    'options' => $question->options ?? []
                ];
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'student' => [
                        'id' => $student->student_number,
                        'name' => $student->first_name . ' ' . $student->last_name,
                        'grade_level' => $student->grade_level,
                        'section' => $student->section
                    ],
                    'assessment' => [
                        'score' => $latestAnswer->score,
                        'total_questions' => $latestAnswer->total_questions ?? count($questions),
                        'percentage' => round(($latestAnswer->score / count($questions)) * 100, 1),
                        'assessment_date' => $latestAnswer->created_at->format('Y-m-d H:i:s')
                    ],
                    'reading_material' => [
                        'title' => $readingMaterial->title,
                        'content' => $readingMaterial->content
                    ],
                    'answer_details' => $answerDetails
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving comprehension details: ' . $e->getMessage()
            ], 500);
        }
    }
}