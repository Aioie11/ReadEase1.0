<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAnswerTagalog;
use App\Models\ReadingMaterial;
use App\Models\ReadingQuestion;
use Illuminate\Support\Facades\Auth;

class StudentAnswerTagalogController extends Controller
{
    public function store(Request $request)
    {
        // Get the current reading material and its questions
        $readingMaterial = ReadingMaterial::where('subject', 'filipino')
            ->where('is_published', true)
            ->latest('published_at')
            ->first();

        if (!$readingMaterial) {
            return redirect()->back()->with('error', 'Walang aktibong reading material na nahanap.');
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
                return redirect()->back()->with('error', 'Kailangan mong mag-login para makapag-submit ng mga sagot.');
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
            StudentAnswerTagalog::create($answerData);

            // Redirect back with success message
            return redirect()->route('student.reports')->with([
                'success' => 'Matagumpay na naipasa ang iyong mga sagot! Score: ' . $score . '/' . $totalQuestions,
                'score' => $score,
                'total_questions' => $totalQuestions
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'May error sa pagpapasa ng iyong mga sagot. Pakisubukan muli.');
        }
    }
}
