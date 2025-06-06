<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReadingAssessment;
use App\Models\Student;
use App\Services\ReadingLevelService;
use Illuminate\Support\Facades\Log;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $grade = $request->input('grade', '7');
            $section = $request->input('section', 'all');
            $language = $request->input('language', 'english');

            // Get comprehensive dashboard data
            $dashboardData = $this->getDashboardData($grade, $section, $language);

            Log::info('Fetched reading reports dashboard:', [
                'grade' => $grade,
                'section' => $section,
                'language' => $language,
                'total_students' => $dashboardData['total_students']
            ]);

            return view('teacher.viewreports', $dashboardData);
        } catch (\Exception $e) {
            Log::error('Error fetching reading reports:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return view('teacher.viewreports', [
                'total_students' => 0,
                'statistics' => [
                    'avg_reading_speed' => 0,
                    'avg_comprehension' => 0,
                    'avg_correct_reading' => 0
                ],
                'reading_level_distribution' => [
                    'Independent' => 0,
                    'Instructional' => 0,
                    'Frustration' => 0
                ],
                'section_data' => [],
                'grade_distribution' => [],
                'metric_cards' => [
                    'reading_level' => 'No Data',
                    'avg_reading_speed' => 0,
                    'avg_comprehension' => 0,
                    'total_sessions' => 0
                ],
                'grade' => $grade ?? '7',
                'section' => $section ?? 'all',
                'language' => $language ?? 'english'
            ])->with('error', 'Error loading reading reports: ' . $e->getMessage());
        }
    }

    private function getDashboardData($grade, $section, $language)
    {
        // Build query for assessments
        $query = ReadingAssessment::where('grade', $grade)
            ->where('language', $language);

        if ($section && $section !== 'all') {
            $query->where('section', $section);
        }

        // Get latest assessment per student
        $assessments = $query->orderBy('assessment_date', 'desc')
            ->get()
            ->groupBy('student_name')
            ->map(function ($studentAssessments) {
                return $studentAssessments->first();
            });

        // Calculate overall statistics
        $totalStudents = $assessments->count();
        $avgReadingSpeed = round($assessments->avg('reading_speed'), 1);
        $avgComprehension = round($assessments->avg('comprehension'), 1);
        $avgCorrectReading = round($assessments->avg('correct_reading'), 1);

        // Calculate reading level distribution using the service
        $readingLevelService = new ReadingLevelService();
        $readingLevels = $assessments->groupBy(function ($assessment) use ($readingLevelService) {
            return $readingLevelService->calculateReadingLevel(
                $assessment->correct_reading,
                $assessment->comprehension
            );
        });

        $levelDistribution = [
            'Independent' => $readingLevels->get('Independent', collect())->count(),
            'Instructional' => $readingLevels->get('Instructional', collect())->count(),
            'Frustration' => $readingLevels->get('Frustration', collect())->count()
        ];

        // Get section-wise data
        $sectionData = $assessments->groupBy('section')->map(function ($sectionAssessments, $sectionName) {
            return [
                'section' => ucfirst($sectionName),
                'student_count' => $sectionAssessments->count(),
                'avg_reading_speed' => round($sectionAssessments->avg('reading_speed'), 1),
                'avg_comprehension' => round($sectionAssessments->avg('comprehension'), 1),
                'avg_correct_reading' => round($sectionAssessments->avg('correct_reading'), 1)
            ];
        })->values();

        // Get grade distribution for chart
        $gradeDistribution = [];
        for ($g = 7; $g <= 10; $g++) {
            $gradeAssessments = ReadingAssessment::where('grade', $g)
                ->where('language', $language)
                ->orderBy('assessment_date', 'desc')
                ->get()
                ->groupBy('student_name')
                ->map(function ($studentAssessments) {
                    return $studentAssessments->first();
                });

            $gradeLevels = $gradeAssessments->groupBy(function ($assessment) use ($readingLevelService) {
                return $readingLevelService->calculateReadingLevel(
                    $assessment->correct_reading,
                    $assessment->comprehension
                );
            });

            $gradeDistribution["Grade $g"] = [
                'Independent' => $gradeLevels->get('Independent', collect())->count(),
                'Instructional' => $gradeLevels->get('Instructional', collect())->count(),
                'Frustration' => $gradeLevels->get('Frustration', collect())->count()
            ];
        }

        // Determine overall reading level using correct criteria
        $overallReadingLevel = 'Instructional';
        if ($avgCorrectReading >= 97 && $avgComprehension >= 80) {
            $overallReadingLevel = 'Independent';
        } elseif ($avgCorrectReading < 90 || $avgComprehension < 59) {
            $overallReadingLevel = 'Frustration';
        }

        // Count total sessions
        $totalSessions = ReadingAssessment::where('grade', $grade)
            ->where('language', $language)
            ->count();

        return [
            'total_students' => $totalStudents,
            'statistics' => [
                'avg_reading_speed' => $avgReadingSpeed,
                'avg_comprehension' => $avgComprehension,
                'avg_correct_reading' => $avgCorrectReading
            ],
            'reading_level_distribution' => $levelDistribution,
            'section_data' => $sectionData,
            'grade_distribution' => $gradeDistribution,
            'metric_cards' => [
                'reading_level' => $overallReadingLevel,
                'avg_reading_speed' => $avgReadingSpeed,
                'avg_comprehension' => $avgComprehension,
                'total_sessions' => $totalSessions
            ],
            'grade' => $grade,
            'section' => $section,
            'language' => $language
        ];
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
                'reading_time' => 'required|integer|min:0', // Allow minimum 0 seconds
                'miscues' => 'required|integer|min:0',
                'total_words' => 'required|integer|min:1',
                'correct_answers' => 'required|integer|min:0',
                'total_questions' => 'required|integer|min:0', // Changed from min:1 to min:0
                'reading_speed' => 'required|integer|min:0',
                'comprehension' => 'required|integer|min:0|max:100',
                'correct_reading' => 'required|integer|min:0|max:100',
                'section' => 'required|string|max:50',
                'language' => 'required|string|max:50',
                'grade' => 'required|string|max:10',
                'assessment_date' => 'required|date'
            ]);

            // Find the student by name and section to get student_id
            $gradeNumber = is_numeric($validatedData['grade']) ? $validatedData['grade'] : (int) str_replace('grade', '', $validatedData['grade']);

            $student = Student::where('grade_level', $gradeNumber)
                ->where('section', ucfirst(strtolower($validatedData['section'])))
                ->where(function ($query) use ($validatedData) {
                    $nameParts = explode(', ', $validatedData['student_name']);
                    if (count($nameParts) >= 2) {
                        $lastName = trim($nameParts[0]);
                        $firstAndMiddle = trim($nameParts[1]);
                        $firstNameParts = explode(' ', $firstAndMiddle);
                        $firstName = trim($firstNameParts[0]);

                        $query->where('last_name', $lastName)
                            ->where('first_name', $firstName);
                    } else {
                        // Fallback: search by full name in different combinations
                        $query->whereRaw('CONCAT(last_name, ", ", first_name) = ?', [$validatedData['student_name']])
                            ->orWhereRaw('CONCAT(first_name, " ", last_name) = ?', [$validatedData['student_name']]);
                    }
                })
                ->first();

            // Create new reading assessment record
            $assessment = ReadingAssessment::create([
                'student_id' => $student ? $student->student_number : null,
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

    public function getStudentAssessments($studentId)
    {
        try {
            // Find the student and get their reading assessments
            $student = Student::with([
                'readingAssessments' => function ($query) {
                    $query->orderBy('assessment_date', 'desc');
                }
            ])->find($studentId);

            if (!$student) {
                return response()->json([
                    'success' => false,
                    'message' => 'Student not found'
                ], 404);
            }

            // Process assessment data for charts
            $assessments = $student->readingAssessments;
            $englishAssessments = $assessments->where('language', 'english');
            $filipinoAssessments = $assessments->where('language', 'filipino');

            // Get latest assessments for each language
            $latestEnglish = $englishAssessments->first();
            $latestFilipino = $filipinoAssessments->first();

            return response()->json([
                'success' => true,
                'data' => [
                    'student' => [
                        'id' => $student->id,
                        'name' => $student->first_name . ' ' . $student->last_name,
                        'grade_level' => $student->grade_level,
                        'section' => $student->section
                    ],
                    'assessments' => [
                        'english' => $latestEnglish ? [
                            'reading_time' => $latestEnglish->reading_time,
                            'total_words' => $latestEnglish->total_words,
                            'reading_speed' => $latestEnglish->reading_speed,
                            'miscues' => $latestEnglish->miscues,
                            'correct_reading' => $latestEnglish->correct_reading,
                            'correct_answers' => $latestEnglish->correct_answers,
                            'total_questions' => $latestEnglish->total_questions,
                            'comprehension' => $latestEnglish->comprehension,
                            'assessment_date' => $latestEnglish->assessment_date
                        ] : null,
                        'filipino' => $latestFilipino ? [
                            'reading_time' => $latestFilipino->reading_time,
                            'total_words' => $latestFilipino->total_words,
                            'reading_speed' => $latestFilipino->reading_speed,
                            'miscues' => $latestFilipino->miscues,
                            'correct_reading' => $latestFilipino->correct_reading,
                            'correct_answers' => $latestFilipino->correct_answers,
                            'total_questions' => $latestFilipino->total_questions,
                            'comprehension' => $latestFilipino->comprehension,
                            'assessment_date' => $latestFilipino->assessment_date
                        ] : null
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching student assessments:', [
                'student_id' => $studentId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error fetching student assessments: ' . $e->getMessage()
            ], 500);
        }
    }

    public function computeStudentAssessment(Request $request)
    {
        try {
            $validated = $request->validate([
                'student_name' => 'required|string',
                'grade' => 'required|string',
                'section' => 'required|string',
                'language' => 'required|string|in:english,filipino',
                'reading_time' => 'required|numeric',
                'miscues' => 'required|integer',
                'total_words' => 'required|integer',
                'correct_answers' => 'required|integer',
                'total_questions' => 'required|integer'
            ]);

            // Calculate reading speed (words per minute)
            $readingSpeed = round(($validated['total_words'] / ($validated['reading_time'] / 60)), 0);

            // Calculate word reading accuracy
            $wordReading = round(((($validated['total_words'] - $validated['miscues']) / $validated['total_words']) * 100), 0);

            // Calculate comprehension percentage
            $comprehension = round(($validated['correct_answers'] / $validated['total_questions']) * 100, 0);

            // Determine reading level using the service for consistency
            $readingLevelService = new ReadingLevelService();
            $readingLevel = $readingLevelService->calculateReadingLevel($wordReading, $comprehension);

            // Create or update the assessment record
            $assessment = ReadingAssessment::updateOrCreate(
                [
                    'student_name' => $validated['student_name'],
                    'grade' => $validated['grade'],
                    'section' => $validated['section'],
                    'language' => $validated['language']
                ],
                [
                    'student_id' => $validated['student_id'],
                    'reading_time' => $validated['reading_time'],
                    'miscues' => $validated['miscues'],
                    'total_words' => $validated['total_words'],
                    'correct_answers' => $validated['correct_answers'],
                    'total_questions' => $validated['total_questions'],
                    'reading_speed' => $readingSpeed,
                    'comprehension' => $comprehension,
                    'correct_reading' => $wordReading,
                    'overall_reading_level' => $readingLevel,
                    'assessment_date' => now()
                ]
            );

            // Get updated reading level distributions
            $allAssessments = ReadingAssessment::select('reading_assessments.*', 'students.name as student_name')
                ->join('students', 'reading_assessments.student_id', '=', 'students.id')
                ->orderBy('reading_assessments.created_at', 'desc')
                ->get();

            $readingLevelDistributionEnglish = $this->calculateReadingLevelDistribution($allAssessments->where('language', 'english'));
            $readingLevelDistributionFilipino = $this->calculateReadingLevelDistribution($allAssessments->where('language', 'filipino'));

            return response()->json([
                'success' => true,
                'data' => [
                    'assessment' => $assessment,
                    'reading_level' => $readingLevel,
                    'metrics' => [
                        'reading_speed' => $readingSpeed,
                        'word_reading' => $wordReading,
                        'comprehension' => $comprehension
                    ],
                    'distributions' => [
                        'english' => $readingLevelDistributionEnglish,
                        'filipino' => $readingLevelDistributionFilipino
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error computing student assessment:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error computing assessment: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getStudentAssessment($studentName, $grade, $section, $language)
    {
        try {
            $assessment = ReadingAssessment::where('student_name', $studentName)
                ->where('grade', $grade)
                ->where('section', $section)
                ->where('language', $language)
                ->latest()
                ->first();

            if (!$assessment) {
                return response()->json([
                    'success' => false,
                    'message' => 'No assessment found for this student'
                ], 404);
            }

            // Determine reading level
            $readingLevel = 'Frustration';
            if ($assessment->correct_reading >= 97 && $assessment->comprehension >= 80) {
                $readingLevel = 'Independent';
            } elseif ($assessment->correct_reading >= 90 && $assessment->correct_reading <= 96 && 
                     $assessment->comprehension >= 59 && $assessment->comprehension <= 79) {
                $readingLevel = 'Instructional';
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'assessment' => $assessment,
                    'reading_level' => $readingLevel,
                    'metrics' => [
                        'reading_speed' => $assessment->reading_speed,
                        'word_reading' => $assessment->correct_reading,
                        'comprehension' => $assessment->comprehension
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching student assessment:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error fetching assessment: ' . $e->getMessage()
            ], 500);
        }
    }

    private function calculateReadingLevelDistribution($assessments)
    {
        $distribution = [];
        
        // Group assessments by grade
        $assessmentsByGrade = $assessments->groupBy('grade');
        
        // Calculate distribution for each grade
        foreach ($assessmentsByGrade as $grade => $gradeAssessments) {
            $gradeLevels = $gradeAssessments->groupBy(function ($assessment) {
                // Get the scores
                $wordReading = $assessment->correct_reading;
                $comprehension = $assessment->comprehension;

                // Determine reading level based on both word reading and comprehension
                if ($wordReading >= 97 && $comprehension >= 80) {
                    return 'Independent';
                } elseif (($wordReading >= 90 && $wordReading <= 96) && ($comprehension >= 59 && $comprehension <= 79)) {
                    return 'Instructional';
                } else {
                    return 'Frustration';
                }
            });

            $distribution["Grade $grade"] = [
                'Independent' => $gradeLevels->get('Independent', collect())->count(),
                'Instructional' => $gradeLevels->get('Instructional', collect())->count(),
                'Frustration' => $gradeLevels->get('Frustration', collect())->count()
            ];
        }

        return $distribution;
    }

    public function getEnglishReadingLevelDistribution()
    {
        try {
            $readingLevelService = new ReadingLevelService();

            // Get distribution using the service
            $distribution = $readingLevelService->getReadingLevelDistribution('english');

            // Count total students
            $assessments = ReadingAssessment::where('language', 'english')
                ->orderBy('assessment_date', 'desc')
                ->get()
                ->groupBy('student_name')
                ->map(function ($studentAssessments) {
                    return $studentAssessments->first();
                });

            // Log the distribution for debugging
            Log::info('English reading level distribution:', [
                'total_students' => $assessments->count(),
                'distribution' => $distribution
            ]);

            return response()->json([
                'success' => true,
                'data' => [
                    'total_students' => $assessments->count(),
                    'distribution' => $distribution
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error calculating English reading level distribution:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error calculating distribution: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getFilipinoReadingLevelDistribution()
    {
        try {
            $readingLevelService = new ReadingLevelService();

            // Get distribution using the service
            $distribution = $readingLevelService->getReadingLevelDistribution('filipino');

            // Count total students
            $assessments = ReadingAssessment::where('language', 'filipino')
                ->orderBy('assessment_date', 'desc')
                ->get()
                ->groupBy('student_name')
                ->map(function ($studentAssessments) {
                    return $studentAssessments->first();
                });

            // Log the distribution for debugging
            Log::info('Filipino reading level distribution:', [
                'total_students' => $assessments->count(),
                'distribution' => $distribution
            ]);

            return response()->json([
                'success' => true,
                'data' => [
                    'total_students' => $assessments->count(),
                    'distribution' => $distribution
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error calculating Filipino reading level distribution:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error calculating distribution: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Calculate and store overall reading performance for a student
     */
    public function calculateOverallReadingPerformance($studentId, $language)
    {
        try {
            // Get the latest assessment for the student in the specified language
            $latestAssessment = ReadingAssessment::where('student_id', $studentId)
                ->where('language', $language)
                ->latest('assessment_date')
                ->first();

            if (!$latestAssessment) {
                return null;
            }

            // Calculate overall reading level based on word reading and comprehension
            $wordReading = $latestAssessment->correct_reading;
            $comprehension = $latestAssessment->comprehension;
            $readingSpeed = $latestAssessment->reading_speed;

            // Determine reading level using the established criteria
            $overallLevel = 'Frustration';
            if ($wordReading >= 97 && $comprehension >= 80) {
                $overallLevel = 'Independent';
            } elseif ($wordReading >= 90 && $wordReading <= 96 && $comprehension >= 59 && $comprehension <= 79) {
                $overallLevel = 'Instructional';
            }

            // Update the assessment record with the calculated overall level
            $latestAssessment->update([
                'overall_reading_level' => $overallLevel
            ]);

            return [
                'student_id' => $studentId,
                'language' => $language,
                'overall_level' => $overallLevel,
                'metrics' => [
                    'reading_speed' => $readingSpeed,
                    'word_reading' => $wordReading,
                    'comprehension' => $comprehension
                ],
                'assessment_date' => $latestAssessment->assessment_date
            ];

        } catch (\Exception $e) {
            Log::error('Error calculating overall reading performance:', [
                'student_id' => $studentId,
                'language' => $language,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }
}