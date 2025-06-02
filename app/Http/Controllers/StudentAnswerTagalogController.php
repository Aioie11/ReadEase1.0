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
            // Get the logged-in user's userId
            $user = Auth::user();
            if (!$user) {
                return redirect()->back()->with('error', 'Kailangan mong mag-login para makapag-submit ng mga sagot.');
            }

            // Save to database with JSON answers
            StudentAnswerTagalog::create([
                'student_id' => $user->userId,
                'answers' => $studentAnswers,
                'score' => $score,
            ]);

            // Store score and total questions in session for graphs
            session([
                'filipino_score' => $score,
                'filipino_total_questions' => $totalQuestions
            ]);

            return redirect()->route('student.reports');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'May error sa pagpapasa ng iyong mga sagot. Pakisubukan muli.');
        }
    }
}
