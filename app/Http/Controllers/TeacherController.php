<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\ReadingMaterial;
use App\Models\TeacherFeedback;

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
        // Handle both 'student_id' and 'student' parameters for compatibility
        $studentIdentifier = $request->get('student_id') ?? $request->get('student');

        if (!$studentIdentifier) {
            return view('teacher.view');
        }

        $student = Student::with('readingAssessments')->where('student_number', $studentIdentifier)->first();

        if (!$student) {
            // Try finding by ID if student_number doesn't work
            $student = Student::with('readingAssessments')->find($studentIdentifier);
        }

        if (!$student) {
            return view('teacher.view');
        }

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

        $students = $query->with('readingAssessments')
            ->orderBy('grade_level')
            ->orderBy('section')
            ->orderBy('last_name')
            ->get()
            ->map(function ($student) {
                $latestAssessment = $student->readingAssessments()->latest('assessment_date')->first();
                $avgScore = $student->readingAssessments()->count() > 0
                    ? round(($student->readingAssessments()->avg('comprehension') + $student->readingAssessments()->avg('correct_reading')) / 2, 1)
                    : 0;

                // Check for complete English and Filipino assessments
                // A complete assessment must have reading data (reading_speed, correct_reading)
                // and comprehension data (comprehension > 0, correct_answers > 0)
                $completeEnglishAssessment = $student->readingAssessments()
                    ->where('language', 'english')
                    ->where('reading_speed', '>', 0)
                    ->where('correct_reading', '>', 0)
                    ->where('comprehension', '>', 0)
                    ->where('correct_answers', '>', 0)
                    ->exists();

                $completeFilipinoAssessment = $student->readingAssessments()
                    ->where('language', 'filipino')
                    ->where('reading_speed', '>', 0)
                    ->where('correct_reading', '>', 0)
                    ->where('comprehension', '>', 0)
                    ->where('correct_answers', '>', 0)
                    ->exists();

                // Check for incomplete assessments (has some data but not complete)
                $incompleteEnglishAssessment = $student->readingAssessments()
                    ->where('language', 'english')
                    ->where(function ($query) {
                    $query->where('reading_speed', '>', 0)
                        ->orWhere('correct_reading', '>', 0)
                        ->orWhere('comprehension', '>', 0)
                        ->orWhere('correct_answers', '>', 0);
                })
                    ->exists();

                $incompleteFilipinoAssessment = $student->readingAssessments()
                    ->where('language', 'filipino')
                    ->where(function ($query) {
                        $query->where('reading_speed', '>', 0)
                            ->orWhere('correct_reading', '>', 0)
                            ->orWhere('comprehension', '>', 0)
                            ->orWhere('correct_answers', '>', 0);
                    })
                    ->exists();

                // Determine status based on assessment completion
                $status = 'No Assessment';
                if ($completeEnglishAssessment && $completeFilipinoAssessment) {
                    $status = 'Complete';
                } elseif (
                    $completeEnglishAssessment || $completeFilipinoAssessment ||
                    $incompleteEnglishAssessment || $incompleteFilipinoAssessment
                ) {
                    $status = 'Incomplete';
                }

                return [
                    'id' => $student->id,
                    'student_number' => $student->student_number,
                    'name' => $student->last_name . ', ' . $student->first_name . ' ' . ($student->middle_name ? $student->middle_name : ''),
                    'initials' => strtoupper(substr($student->first_name, 0, 1) . substr($student->last_name, 0, 1)),
                    'grade_level' => $student->grade_level,
                    'section' => $student->section,
                    'total_assessments' => $student->readingAssessments()->count(),
                    'latest_score' => $avgScore,
                    'latest_assessment_date' => $latestAssessment ? $latestAssessment->assessment_date : null,
                    'status' => $status
                ];
            });

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
                    'name' => $student->last_name . ', ' . $student->first_name . ' ' . ($student->middle_name ? $student->middle_name : '')
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

            \Log::info('Searching for student answers', [
                'student_id' => $studentId,
                'language' => $language,
                'answer_model' => $answerModel,
                'found_answer' => $latestAnswer ? 'Yes' : 'No',
                'answer_data' => $latestAnswer ? $latestAnswer->toArray() : null
            ]);

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

            $questions = $readingMaterial->comprehensionQuestions()->orderBy('order')->get();

            // Process answers and compare with correct answers
            $answerDetails = [];
            $studentAnswers = $latestAnswer->answers ?? []; // Get the JSON answers array

            foreach ($questions as $index => $question) {
                $questionNumber = $index + 1;
                $questionKey = 'c' . $questionNumber;

                // Get student answer from the JSON answers array
                $studentAnswer = $studentAnswers[$questionKey] ?? '';
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
            \Log::error('Error in getStudentComprehensionDetails', [
                'student_id' => $studentId,
                'language' => $language,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error retrieving comprehension details: ' . $e->getMessage()
            ], 500);
        }
    }

    public function saveFeedback(Request $request)
    {
        try {
            $request->validate([
                'student_id' => 'required|string',
                'language' => 'required|string|in:english,filipino',
                'grade_level' => 'required|integer',
                'section' => 'required|string',
                'strengths' => 'nullable|string',
                'areas_for_improvement' => 'nullable|string',
                'recommendations' => 'nullable|string'
            ]);

            $user = Auth::user();

            // Verify student exists
            $student = Student::where('student_number', $request->student_id)->first();
            if (!$student) {
                return response()->json([
                    'success' => false,
                    'message' => 'Student not found with student number: ' . $request->student_id
                ], 404);
            }

            // Check if feedback already exists for this student and language
            $existingFeedback = TeacherFeedback::where('student_id', $request->student_id)
                ->where('language', $request->language)
                ->where('is_sent', false)
                ->first();

            if ($existingFeedback) {
                // Update existing feedback
                $existingFeedback->update([
                    'teacher_id' => $user->id,
                    'teacher_name' => $user->name,
                    'grade_level' => $request->grade_level,
                    'section' => $request->section,
                    'strengths' => $request->strengths,
                    'areas_for_improvement' => $request->areas_for_improvement,
                    'recommendations' => $request->recommendations
                ]);
                $feedback = $existingFeedback;
            } else {
                // Create new feedback
                $feedback = TeacherFeedback::create([
                    'student_id' => $request->student_id,
                    'teacher_id' => $user->id,
                    'teacher_name' => $user->name,
                    'language' => $request->language,
                    'grade_level' => $request->grade_level,
                    'section' => $request->section,
                    'strengths' => $request->strengths,
                    'areas_for_improvement' => $request->areas_for_improvement,
                    'recommendations' => $request->recommendations
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Feedback saved successfully!',
                'feedback' => $feedback
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error saving feedback: ' . $e->getMessage()
            ], 500);
        }
    }

    public function sendFeedback(Request $request)
    {
        try {
            $request->validate([
                'feedback_id' => 'required|integer',
                'student_id' => 'required|string'
            ]);

            $feedback = TeacherFeedback::findOrFail($request->feedback_id);

            // Verify the feedback belongs to the specified student
            if ($feedback->student_id !== $request->student_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Feedback does not belong to the specified student'
                ], 400);
            }

            // Mark feedback as sent
            $feedback->update([
                'is_sent' => true,
                'sent_at' => now()
            ]);

            // Get student information
            $student = Student::where('student_number', $request->student_id)->first();

            return response()->json([
                'success' => true,
                'message' => "Successfully sent feedback to {$student->first_name} {$student->last_name}",
                'feedback' => $feedback
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error sending feedback: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getFeedbackHistory(Request $request)
    {
        try {
            $studentId = $request->get('student_id');
            $language = $request->get('language', 'english');

            $query = TeacherFeedback::with('student');

            if ($studentId) {
                $query->where('student_id', $studentId);
            }

            if ($language) {
                $query->where('language', $language);
            }

            $feedback = $query->orderBy('created_at', 'desc')->get();

            return response()->json([
                'success' => true,
                'feedback' => $feedback
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving feedback history: ' . $e->getMessage()
            ], 500);
        }
    }

    public function readingAssessmentControls()
    {
        return view('teacher.reading-assessment-controls');
    }
}