<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAnswerEnglish;
use App\Models\ReadingMaterial;
use App\Models\ReadingQuestion;
use Illuminate\Support\Facades\Auth;

class StudentAnswerEnglishController extends Controller
{
    public function store(Request $request)
    {
        // Get the current reading material and its questions
        $readingMaterial = ReadingMaterial::where('subject', 'english')
            ->where('is_published', true)
            ->latest('published_at')
            ->first();

        if (!$readingMaterial) {
            return redirect()->back()->with('error', 'No active reading material found.');
        }

        $questions = $readingMaterial->questions()->orderBy('id')->get();
        
        // Get correct answers from the database
        $correctAnswers = [];
        foreach ($questions as $index => $question) {
            $correctAnswers['c' . ($index + 1)] = $question->correct_answer;
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
            if ($request->$key == $value) {
                $score++;
            }
        }

        try {
            // Get the logged-in user's userId
            $user = Auth::user();
            if (!$user) {
                return redirect()->back()->with('error', 'You must be logged in to submit answers.');
            }

            // Prepare answer data
            $answerData = [
                'student_id' => $user->userId, // Use userId instead of internal ID
                'score' => $score,
                'total_questions' => $totalQuestions
            ];

            // Add individual answers
            foreach ($questions as $index => $question) {
                $answerData['c' . ($index + 1)] = $request->input('c' . ($index + 1));
            }

            // Save to database
            StudentAnswerEnglish::create($answerData);

            // For regular form submissions, redirect with session message
            return redirect()->route('student.reports')->with([
                'success' => 'Answers submitted successfully! Your score: ' . $score . '/' . $totalQuestions,
                'score' => $score,
                'total_questions' => $totalQuestions
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'There was an error submitting your answers. Please try again.');
        }
    }
}
