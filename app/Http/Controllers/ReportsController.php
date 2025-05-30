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
        if ($totalWords === 0)
            return 'N/A';

        $accuracy = (($totalWords - $miscues) / $totalWords) * 100;

        if ($accuracy >= 98)
            return 'Independent';
        if ($accuracy >= 95)
            return 'Instructional';
        return 'Frustration';
    }

    public function saveReadingAssessment(Request $request)
    {
        try {
            // Validate the incoming data
            $validatedData = $request->validate([
                'student_name' => 'required|string|max:255',
                'reading_time' => 'required|integer|min:0',
                'miscues' => 'required|integer|min:0',
                'total_words' => 'required|integer|min:1',
                'correct_answers' => 'required|integer|min:0',
                'total_questions' => 'required|integer|min:1',
                'reading_speed' => 'required|integer|min:0',
                'comprehension' => 'required|integer|min:0|max:100',
                'correct_reading' => 'required|integer|min:0|max:100',
                'section' => 'required|string|max:50',
                'language' => 'required|string|max:50',
                'grade' => 'required|string|max:10',
                'assessment_date' => 'required|date'
            ]);

            // Create new reading assessment record
            $assessment = ReadingAssessment::create([
                'student_name' => $validatedData['student_name'],
                'reading_time' => $validatedData['reading_time'],
                'miscues' => $validatedData['miscues'],
                'total_words' => $validatedData['total_words'],
                'correct_answers' => $validatedData['correct_answers'],
                'total_questions' => $validatedData['total_questions'],
                'reading_speed' => $validatedData['reading_speed'],
                'comprehension' => $validatedData['comprehension'],
                'correct_reading' => $validatedData['correct_reading'],
                'section' => $validatedData['section'],
                'language' => $validatedData['language'],
                'grade' => $validatedData['grade'],
                'assessment_date' => $validatedData['assessment_date']
            ]);

            Log::info('Reading assessment saved successfully:', [
                'assessment_id' => $assessment->id,
                'student_name' => $assessment->student_name,
                'grade' => $assessment->grade,
                'section' => $assessment->section
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Assessment saved successfully',
                'assessment_id' => $assessment->id
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation failed for reading assessment:', [
                'errors' => $e->errors(),
                'input' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error saving reading assessment:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error saving assessment: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getGradeLevelData(Request $request)
    {
        try {
            $grade = $request->input('grade', '7');
            $language = $request->input('language', 'english');
            $section = $request->input('section');

            // Build query
            $query = ReadingAssessment::where('grade', $grade)
                ->where('language', $language);

            if ($section && $section !== 'all') {
                $query->where('section', $section);
            }

            // Get assessments grouped by student (latest assessment per student)
            $assessments = $query->orderBy('assessment_date', 'desc')
                ->get()
                ->groupBy('student_name')
                ->map(function ($studentAssessments) {
                    return $studentAssessments->first(); // Get latest assessment
                });

            // Calculate grade-level statistics
            $totalStudents = $assessments->count();
            $avgReadingSpeed = $assessments->avg('reading_speed');
            $avgComprehension = $assessments->avg('comprehension');
            $avgCorrectReading = $assessments->avg('correct_reading');

            // Group by reading levels
            $readingLevels = $assessments->groupBy(function ($assessment) {
                $accuracy = $assessment->correct_reading;
                if ($accuracy >= 97)
                    return 'Independent';
                if ($accuracy >= 90)
                    return 'Instructional';
                return 'Frustration';
            });

            // Calculate reading level distribution
            $levelDistribution = [
                'Independent' => $readingLevels->get('Independent', collect())->count(),
                'Instructional' => $readingLevels->get('Instructional', collect())->count(),
                'Frustration' => $readingLevels->get('Frustration', collect())->count()
            ];

            // Get section-wise data
            $sectionData = $assessments->groupBy('section')->map(function ($sectionAssessments, $sectionName) {
                return [
                    'section' => $sectionName,
                    'student_count' => $sectionAssessments->count(),
                    'avg_reading_speed' => round($sectionAssessments->avg('reading_speed'), 1),
                    'avg_comprehension' => round($sectionAssessments->avg('comprehension'), 1),
                    'avg_correct_reading' => round($sectionAssessments->avg('correct_reading'), 1)
                ];
            })->values();

            return response()->json([
                'success' => true,
                'data' => [
                    'grade' => $grade,
                    'language' => $language,
                    'total_students' => $totalStudents,
                    'statistics' => [
                        'avg_reading_speed' => round($avgReadingSpeed, 1),
                        'avg_comprehension' => round($avgComprehension, 1),
                        'avg_correct_reading' => round($avgCorrectReading, 1)
                    ],
                    'reading_level_distribution' => $levelDistribution,
                    'section_data' => $sectionData,
                    'assessments' => $assessments->values()
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching grade level data:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error fetching grade level data: ' . $e->getMessage()
            ], 500);
        }
    }
}