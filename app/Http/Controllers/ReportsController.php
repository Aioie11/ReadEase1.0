<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReadingAssessment;
use Illuminate\Support\Facades\Log;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $section = $request->input('section', 'Narra');
            $language = $request->input('language', 'English');

            // Get the latest reading assessment for each student in the section
            $students = ReadingAssessment::where('section', $section)
                ->where('language', $language)
                ->orderBy('assessment_date', 'desc')
                ->get()
                ->groupBy('student_name')
                ->map(function ($assessments) {
                    $latest = $assessments->first();
                    return [
                        'student_name' => $latest->student_name,
                        'reading_time' => $latest->reading_time,
                        'miscues' => $latest->miscues,
                        'total_words' => $latest->total_words,
                        'reading_speed' => $latest->reading_speed,
                        'section' => $latest->section,
                        'language' => $latest->language,
                        'assessment_date' => $latest->assessment_date,
                        'comprehension' => 'N/A', // You can add comprehension data if available
                        'word_label' => $this->getWordRecognitionLabel($latest->miscues, $latest->total_words)
                    ];
                })
                ->values();

            Log::info('Fetched reading reports:', [
                'section' => $section,
                'language' => $language,
                'student_count' => $students->count()
            ]);

            return view('teacher.viewreports', compact('students', 'section', 'language'));
        } catch (\Exception $e) {
            Log::error('Error fetching reading reports:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return view('teacher.viewreports', [
                'students' => collect([]),
                'section' => $section ?? 'Narra',
                'language' => $language ?? 'English'
            ])->with('error', 'Error loading reading reports: ' . $e->getMessage());
        }
    }

    private function getWordRecognitionLabel($miscues, $totalWords)
    {
        if ($totalWords === 0) return 'N/A';
        
        $accuracy = (($totalWords - $miscues) / $totalWords) * 100;
        
        if ($accuracy >= 98) return 'Independent';
        if ($accuracy >= 95) return 'Instructional';
        return 'Frustration';
    }
} 