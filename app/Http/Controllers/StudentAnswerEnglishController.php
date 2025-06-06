<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAnswerEnglish;
use App\Models\ReadingMaterial;
use App\Models\ReadingQuestion;
use App\Models\ReadingAssessment;
use App\Services\ReadingLevelService;
use Illuminate\Support\Facades\Auth;

class StudentAnswerEnglishController extends Controller
{
    public function store(Request $request)
    {
        // Get the authenticated user
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        // Get the current reading material and its questions for the student's grade
        $readingMaterial = ReadingMaterial::where('subject', 'english')
            ->where('grade_level', $user->grade)
            ->where('is_published', true)
            ->first();

        if (!$readingMaterial) {
            return redirect()->back()->with('error', 'No active reading material found for your grade level.');
        }

        $questions = $readingMaterial->questions()->orderBy('id')->get();
        
        // Get correct answers from the database
        $correctAnswers = [];
        $studentAnswers = [];
        foreach ($questions as $index => $question) {
            $questionKey = 'c' . ($index + 1);
            $correctAnswers[$questionKey] = $question->correct_answer;
            $studentAnswers[$questionKey] = $request->input($questionKey);
        }

        // Validate input
        $validationRules = [];
        foreach ($questions as $index => $question) {
            $validationRules['c' . ($index + 1)] = 'required';
        }
        $request->validate($validationRules);

        // Calculate score
        $score = 0;
        $totalQuestions = count($correctAnswers);
        foreach ($correctAnswers as $key => $value) {
            if ($studentAnswers[$key] == $value) {
                $score++;
            }
        }

        try {
            // Save to database with JSON answers
            StudentAnswerEnglish::create([
                'student_id' => $user->userId,
                'answers' => $studentAnswers,
                'score' => $score,
                'reading_time' => $request->input('reading_time'),
                'reading_speed' => $request->input('reading_speed'),
            ]);

            // Store score and total questions in session for graphs
            session([
                'english_score' => $score,
                'english_total_questions' => $totalQuestions,
                'english_reading_time' => $request->input('reading_time'),
                'english_reading_speed' => $request->input('reading_speed')
            ]);

            // Update reading assessment with comprehension data
            $this->updateReadingAssessmentWithComprehension($user, $score, $totalQuestions, 'english');

            return redirect()->route('student.reports');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'There was an error submitting your answers. Please try again.');
        }
    }

    /**
     * Update reading assessment with comprehension data when student completes questions
     */
    private function updateReadingAssessmentWithComprehension($user, $score, $totalQuestions, $language)
    {
        try {
            // Find the latest reading assessment for this student and language
            $assessment = ReadingAssessment::where('student_id', $user->userId)
                ->where('language', $language)
                ->latest('assessment_date')
                ->first();

            if ($assessment) {
                // Calculate comprehension percentage
                $comprehension = $totalQuestions > 0 ? round(($score / $totalQuestions) * 100) : 0;

                // Update the assessment with comprehension data
                $assessment->update([
                    'correct_answers' => $score,
                    'total_questions' => $totalQuestions,
                    'comprehension' => $comprehension
                ]);

                // Recalculate overall reading level with new comprehension data
                $readingLevelService = new ReadingLevelService();
                $newReadingLevel = $readingLevelService->calculateReadingLevel(
                    $assessment->correct_reading,
                    $comprehension
                );

                $assessment->update(['overall_reading_level' => $newReadingLevel]);

                \Log::info('Updated reading assessment with comprehension data', [
                    'student_id' => $user->userId,
                    'language' => $language,
                    'score' => $score,
                    'total_questions' => $totalQuestions,
                    'comprehension' => $comprehension,
                    'new_reading_level' => $newReadingLevel
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Error updating reading assessment with comprehension data', [
                'student_id' => $user->userId,
                'language' => $language,
                'error' => $e->getMessage()
            ]);
        }
    }
}
