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
                return redirect()->back()->with('error', 'You must be logged in to submit answers.');
            }

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

            return redirect()->route('student.reports');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'There was an error submitting your answers. Please try again.');
        }
    }
}
