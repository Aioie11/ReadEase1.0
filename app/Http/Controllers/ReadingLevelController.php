<?php

namespace App\Http\Controllers;

use App\Models\StudentReadingLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReadingLevelController extends Controller
{
    public function getReadingLevelStats()
    {
        $stats = [];
        $grades = [7, 8, 9, 10];
        $subjects = ['english', 'filipino'];

        foreach ($grades as $grade) {
            $stats[$grade] = [];
            foreach ($subjects as $subject) {
                $levelCounts = StudentReadingLevel::where('grade_level', $grade)
                    ->where('subject', $subject)
                    ->select('reading_level', DB::raw('count(*) as count'))
                    ->groupBy('reading_level')
                    ->get()
                    ->pluck('count', 'reading_level')
                    ->toArray();

                $stats[$grade][$subject] = [
                    'beginner' => $levelCounts['beginner'] ?? 0,
                    'intermediate' => $levelCounts['intermediate'] ?? 0,
                    'advanced' => $levelCounts['advanced'] ?? 0
                ];
            }
        }

        return response()->json($stats);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,student_number',
            'grade_level' => 'required|integer|between:7,10',
            'reading_level' => 'required|in:beginner,intermediate,advanced',
            'subject' => 'required|in:english,filipino',
            'assessment_date' => 'required|date'
        ]);

        $readingLevel = StudentReadingLevel::create($validated);

        return response()->json([
            'success' => true,
            'data' => $readingLevel
        ]);
    }
} 