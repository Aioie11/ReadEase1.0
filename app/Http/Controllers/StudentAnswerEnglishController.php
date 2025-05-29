<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAnswerEnglish;

class StudentAnswerEnglishController extends Controller
{
    public function store(Request $request)
    {
        // Correct answers
        $correctAnswers = [
            'c1' => 'B',
            'c2' => 'A',
            'c3' => 'C',
            'c4' => 'C',
            'c5' => 'D',
            'c6' => 'C',
            'c7' => 'D',
        ];

        // Validate input
        $request->validate([
            'student_id' => 'required',
            'c1' => 'required',
            'c2' => 'required',
            'c3' => 'required',
            'c4' => 'required',
            'c5' => 'required',
            'c6' => 'required',
            'c7' => 'required',
            'reading_time' => 'required|integer|min:0',
        ]);

        // Calculate score
        $score = 0;
        foreach ($correctAnswers as $key => $value) {
            if ($request->$key == $value) {
                $score++;
            }
        }

        try {
            // Calculate reading speed (words per minute)
            $totalWords = 250; // Approximate word count of the passage
            $readingTimeMinutes = $request->reading_time / 60;
            $readingSpeed = $readingTimeMinutes > 0 ? round($totalWords / $readingTimeMinutes) : 0;

            // Save to database
            StudentAnswerEnglish::create([
                'student_id' => $request->student_id,
                'c1' => $request->c1,
                'c2' => $request->c2,
                'c3' => $request->c3,
                'c4' => $request->c4,
                'c5' => $request->c5,
                'c6' => $request->c6,
                'c7' => $request->c7,
                'score' => $score,
                'reading_time' => $request->reading_time,
                'reading_speed' => $readingSpeed,
            ]);

            // Check if the request is AJAX
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Answers submitted successfully! Your score: ' . $score . '/7',
                    'score' => $score,
                    'total_questions' => 7
                ]);
            }

            // For regular form submissions, redirect with session message
            return redirect()->route('student.reports')->with([
                'success' => 'Answers submitted successfully! Your score: ' . $score . '/7',
                'score' => $score,
                'total_questions' => 7
            ]);
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'There was an error submitting your answers. Please try again.'
                ], 500);
            }
            return redirect()->back()->with('error', 'There was an error submitting your answers. Please try again.');
        }
    }
}
