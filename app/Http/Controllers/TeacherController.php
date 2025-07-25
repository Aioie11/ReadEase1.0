<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\ReadingMaterial;
use App\Models\ReadingAssessment;
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

        $student = Student::where('student_number', $studentIdentifier)->first();

        if (!$student) {
            // Try finding by ID if student_number doesn't work
            $student = Student::find($studentIdentifier);
        }

        if (!$student) {
            return view('teacher.view');
        }

        // Get currently published reading materials for this student's grade
        $currentEnglishMaterial = ReadingMaterial::where('grade_level', $student->grade_level)
            ->where('subject', 'english')
            ->where('is_published', true)
            ->first();

        $currentFilipinoMaterial = ReadingMaterial::where('grade_level', $student->grade_level)
            ->where('subject', 'filipino')
            ->where('is_published', true)
            ->first();

        // Get reading assessments for CURRENT published materials only (for graphs)
        $currentReadingAssessments = collect();

        if ($currentEnglishMaterial) {
            $englishAssessment = ReadingAssessment::with('readingMaterial')
                ->where('student_id', $student->student_number)
                ->where('language', 'english')
                ->where('reading_material_id', $currentEnglishMaterial->id)
                ->latest('assessment_date')
                ->first();
            if ($englishAssessment) {
                $currentReadingAssessments->push($englishAssessment);
            }
        }

        if ($currentFilipinoMaterial) {
            $filipinoAssessment = ReadingAssessment::with('readingMaterial')
                ->where('student_id', $student->student_number)
                ->where('language', 'filipino')
                ->where('reading_material_id', $currentFilipinoMaterial->id)
                ->latest('assessment_date')
                ->first();
            if ($filipinoAssessment) {
                $currentReadingAssessments->push($filipinoAssessment);
            }
        }

        // Get ALL reading assessments for this student (for Reading Results and Answer Results tables)
        // This ensures historical records are preserved when new materials are published
        $allReadingAssessments = ReadingAssessment::with('readingMaterial')
            ->where('student_id', $student->student_number)
            ->orderBy('assessment_date', 'desc')
            ->get();

        // Add the current assessments to the student object for graphs
        $student->readingAssessments = $currentReadingAssessments;

        // Add all assessments for historical data display
        $student->allReadingAssessments = $allReadingAssessments;

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
                    ? round((($student->readingAssessments()->avg('comprehension') ?: 0) + ($student->readingAssessments()->avg('correct_reading') ?: 0)) / 2, 1)
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

    public function getStudentComprehensionDetails(Request $request, $studentId, $language = 'english')
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

            // Get the reading material ID from request if provided
            $readingMaterialId = $request->get('reading_material_id');

            // Get the comprehension assessment for this student and language
            $answerModel = $language === 'english' ?
                \App\Models\StudentAnswerEnglish::class :
                \App\Models\StudentAnswerTagalog::class;

            // If reading material ID is provided, get the specific answer for that material
            // Otherwise, get the latest answer (fallback for backward compatibility)
            if ($readingMaterialId) {
                $latestAnswer = $answerModel::where('student_id', $studentId)
                    ->where('reading_material_id', $readingMaterialId)
                    ->latest('created_at')
                    ->first();
            } else {
                $latestAnswer = $answerModel::where('student_id', $studentId)
                    ->latest('created_at')
                    ->first();
            }

            \Log::info('Searching for student answers', [
                'student_id' => $studentId,
                'language' => $language,
                'reading_material_id' => $readingMaterialId,
                'answer_model' => $answerModel,
                'found_answer' => $latestAnswer ? 'Yes' : 'No',
                'answer_data' => $latestAnswer ? $latestAnswer->toArray() : null
            ]);

            if (!$latestAnswer) {
                $languageDisplay = $language === 'english' ? 'English' : 'Filipino';
                return response()->json([
                    'success' => false,
                    'message' => "This student has not completed the {$languageDisplay} comprehension assessment yet. Please ensure the student has answered the questionnaire before viewing details."
                ], 404);
            }

            // Get the corresponding ReadingAssessment record for accurate score information
            // If we have a specific reading material ID, get the assessment for that material
            // Otherwise, fall back to the latest assessment for backward compatibility
            $readingAssessment = null;
            if ($readingMaterialId) {
                $readingAssessment = \App\Models\ReadingAssessment::where('student_id', $studentId)
                    ->where('language', $language)
                    ->where('reading_material_id', $readingMaterialId)
                    ->latest('created_at')
                    ->first();

                \Log::info('Fetching reading assessment for specific material', [
                    'student_id' => $studentId,
                    'language' => $language,
                    'reading_material_id' => $readingMaterialId,
                    'found_assessment' => $readingAssessment ? 'Yes' : 'No',
                    'assessment_score' => $readingAssessment ? $readingAssessment->correct_answers : 'N/A'
                ]);
            } else {
                $readingAssessment = \App\Models\ReadingAssessment::where('student_id', $studentId)
                    ->where('language', $language)
                    ->latest('created_at')
                    ->first();

                \Log::info('Fetching latest reading assessment (fallback)', [
                    'student_id' => $studentId,
                    'language' => $language,
                    'found_assessment' => $readingAssessment ? 'Yes' : 'No',
                    'assessment_score' => $readingAssessment ? $readingAssessment->correct_answers : 'N/A'
                ]);
            }

            // Get the reading material that the student actually answered
            // Priority order: 1) Requested reading material ID, 2) Student answer record, 3) Latest published
            $readingMaterial = null;

            // First priority: Use the specific reading material ID from the request
            if ($readingMaterialId) {
                $readingMaterial = \App\Models\ReadingMaterial::find($readingMaterialId);
                \Log::info('Using reading material from request parameter', [
                    'requested_reading_material_id' => $readingMaterialId,
                    'material_title' => $readingMaterial ? $readingMaterial->title : 'NOT FOUND'
                ]);
            }

            // Second priority: Get it from the student answer record (if reading_material_id is set)
            if (!$readingMaterial && $latestAnswer->reading_material_id) {
                $readingMaterial = \App\Models\ReadingMaterial::find($latestAnswer->reading_material_id);
                \Log::info('Using reading material from student answer record', [
                    'reading_material_id' => $latestAnswer->reading_material_id,
                    'material_title' => $readingMaterial ? $readingMaterial->title : 'NOT FOUND'
                ]);
            }

            // Third priority: Fallback to latest published material if not found
            if (!$readingMaterial) {
                $readingMaterial = \App\Models\ReadingMaterial::where('subject', $language)
                    ->where('is_published', true)
                    ->latest('published_at')
                    ->first();
                \Log::warning('Fallback to latest published material', [
                    'language' => $language,
                    'student_id' => $studentId,
                    'material_title' => $readingMaterial ? $readingMaterial->title : 'NOT FOUND'
                ]);
            }

            if (!$readingMaterial) {
                \Log::warning('No reading material found', [
                    'language' => $language,
                    'student_id' => $studentId
                ]);
                $languageDisplay = $language === 'english' ? 'English' : 'Filipino';
                return response()->json([
                    'success' => false,
                    'message' => "No {$languageDisplay} reading material has been published by the admin yet. Please contact the administrator to add reading materials and questions."
                ], 404);
            }

            // Use the same questions relationship that students use when answering
            $questions = $readingMaterial->questions()->orderBy('id')->get();

            \Log::info('Found reading material and questions', [
                'reading_material_id' => $readingMaterial->id,
                'reading_material_title' => $readingMaterial->title,
                'questions_count' => $questions->count(),
                'language' => $language,
                'questions_table' => 'reading_questions'
            ]);

            // Process answers and compare with correct answers
            $answerDetails = [];
            $studentAnswers = $latestAnswer->answers ?? []; // Get the JSON answers array

            \Log::info('Processing student answers', [
                'student_answers' => $studentAnswers,
                'questions_count' => $questions->count(),
                'student_id' => $studentId,
                'language' => $language,
                'reading_material_id' => $readingMaterial->id,
                'reading_material_title' => $readingMaterial->title
            ]);

            foreach ($questions as $index => $question) {
                $questionNumber = $index + 1;
                $questionKey = 'c' . $questionNumber;

                // Get student answer from the JSON answers array
                $studentAnswer = $studentAnswers[$questionKey] ?? '';
                $correctAnswer = $question->correct_answer;

                // Use the same comparison logic as student submission for consistency
                // For English, use simple equality comparison
                // For Filipino/Tagalog, use case-insensitive trimmed comparison
                if ($language === 'english') {
                    $isCorrect = $studentAnswer == $correctAnswer;
                } else {
                    $isCorrect = strtolower(trim($studentAnswer)) == strtolower(trim($correctAnswer));
                }

                $answerDetails[] = [
                    'question_number' => $questionNumber,
                    'question' => $question->question,
                    'student_answer' => $studentAnswer,
                    'correct_answer' => $correctAnswer,
                    'is_correct' => $isCorrect,
                    'options' => $question->options ?? [],
                    'question_id' => $question->id // Add question ID for debugging
                ];

                // Log only incorrect answers for debugging
                if (!$isCorrect) {
                    \Log::debug('Incorrect answer found', [
                        'question_id' => $question->id,
                        'question_number' => $questionNumber,
                        'student_answer' => $studentAnswer,
                        'correct_answer' => $correctAnswer,
                        'comparison_method' => $language === 'english' ? 'exact' : 'case_insensitive_trimmed'
                    ]);
                }
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
                        'score' => $readingAssessment ? $readingAssessment->correct_answers : $latestAnswer->score,
                        'total_questions' => $readingAssessment ? $readingAssessment->total_questions : count($questions),
                        'percentage' => $readingAssessment ?
                            ($readingAssessment->total_questions > 0 ? round(($readingAssessment->correct_answers / $readingAssessment->total_questions) * 100, 1) : 0) :
                            (count($questions) > 0 ? round(($latestAnswer->score / count($questions)) * 100, 1) : 0),
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

            // Get the currently published reading material for this grade and language
            $readingMaterial = ReadingMaterial::where('grade_level', $request->grade_level)
                ->where('subject', $request->language)
                ->where('is_published', true)
                ->first();

            // Check if feedback already exists for this student, language, and reading material
            $existingFeedback = TeacherFeedback::where('student_id', $request->student_id)
                ->where('language', $request->language)
                ->where('reading_material_id', $readingMaterial ? $readingMaterial->id : null)
                ->where('is_sent', false)
                ->first();

            if ($existingFeedback) {
                // Update existing feedback
                $existingFeedback->update([
                    'teacher_id' => $user->id,
                    'teacher_name' => $user->name,
                    'grade_level' => $request->grade_level,
                    'section' => $request->section,
                    'reading_material_id' => $readingMaterial ? $readingMaterial->id : null,
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
                    'reading_material_id' => $readingMaterial ? $readingMaterial->id : null,
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

            $query = TeacherFeedback::with(['student', 'readingMaterial']);

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