<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAnswerEnglish;

class StudentAnswerTagalogController extends Controller
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
        ]);

        // Calculate score
        $score = 0;
        foreach ($correctAnswers as $key => $value) {
            if ($request->$key == $value) {
                $score++;
            }
        }

        // Save to database
        StudentAnswerTagalog::create([
            'student_id' => $request->student_id,
            'c1' => $request->c1,
            'c2' => $request->c2,
            'c3' => $request->c3,
            'c4' => $request->c4,
            'c5' => $request->c5,
            'c6' => $request->c6,
            'score' => $score,
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Answers submitted successfully! Score: ' . $score . '/6');
    }
}
