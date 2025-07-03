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
            $grade = (string) $request->input('grade', '7');
            $section = (string) $request->input('section', 'all');
            $language = (string) $request->input('language', 'english');

            // Debug logging
            Log::info('ViewReports request received:', [
                'grade' => $grade,
                'section' => $section,
                'language' => $language,
                'all_params' => $request->all()
            ]);

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
                    'comprehension_level' => 'No Data',
                    'total_sessions' => 0
                ],
                'grade' => $grade ?? '7',
                'section' => $section ?? 'all',
                'language' => $language ?? 'english'
            ])->with('error', 'Error loading reading reports: ' . $e->getMessage());
        }
    }

    public function filipinoReport(Request $request)
    {
        try {
            $grade = (string) $request->input('grade', '7');
            $section = (string) $request->input('section', 'all');
            $language = 'filipino'; // Force Filipino language

            // Get comprehensive dashboard data for Filipino
            $dashboardData = $this->getDashboardData($grade, $section, $language);

            Log::info('Fetched Filipino reading reports dashboard:', [
                'grade' => $grade,
                'section' => $section,
                'language' => $language,
                'total_students' => $dashboardData['total_students']
            ]);

            return view('teacher.filipinoreport', $dashboardData);
        } catch (\Exception $e) {
            Log::error('Error fetching Filipino reading reports:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return view('teacher.filipinoreport', [
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
                    'comprehension_level' => 'No Data',
                    'total_sessions' => 0
                ],
                'grade' => $grade ?? '7',
                'section' => $section ?? 'all',
                'language' => 'filipino'
            ])->with('error', 'Error loading Filipino reading reports: ' . $e->getMessage());
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

        // Calculate reading level distribution using Word Reading only for teacher view consistency
        $readingLevels = $assessments->groupBy(function ($assessment) {
            return $this->calculateWordReadingLevel($assessment->correct_reading);
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

        // Get grade distribution for chart (using Word Reading only for teacher view consistency)
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

            $gradeLevels = $gradeAssessments->groupBy(function ($assessment) {
                return $this->calculateWordReadingLevel($assessment->correct_reading);
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

        // Determine comprehension level based on average comprehension score
        $comprehensionLevel = 'Instructional';
        if ($avgComprehension >= 80) {
            $comprehensionLevel = 'Independent';
        } elseif ($avgComprehension < 59) {
            $comprehensionLevel = 'Frustration';
        }

        // Count total sessions
        $totalSessions = ReadingAssessment::where('grade', $grade)
            ->where('language', $language)
            ->count();

        // Get comprehension level distribution for the second chart
        $comprehensionDistribution = $this->calculateTeacherComprehensionLevelDistribution($language, null, null);

        return [
            'total_students' => $totalStudents,
            'statistics' => [
                'avg_reading_speed' => $avgReadingSpeed,
                'avg_comprehension' => $avgComprehension,
                'avg_correct_reading' => $avgCorrectReading
            ],
            'reading_level_distribution' => $levelDistribution,
            'comprehension_level_distribution' => $comprehensionDistribution['distribution'],
            'section_data' => $sectionData,
            'grade_distribution' => $gradeDistribution,
            'metric_cards' => [
                'reading_level' => $overallReadingLevel,
                'avg_reading_speed' => $avgReadingSpeed,
                'avg_comprehension' => $avgComprehension,
                'comprehension_level' => $comprehensionLevel,
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

        // Use standardized Word Reading thresholds for consistency
        return $this->calculateWordReadingLevel($accuracy);
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

            // Group by reading levels using the standardized method
            $readingLevels = $assessments->groupBy(function ($assessment) {
                return $this->calculateWordReadingLevel($assessment->correct_reading);
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
            } elseif (
                $assessment->correct_reading >= 90 && $assessment->correct_reading <= 96 &&
                $assessment->comprehension >= 59 && $assessment->comprehension <= 79
            ) {
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
            // Get distribution based on Word Reading only
            $distribution = $this->calculateWordReadingLevelDistribution('english');

            return response()->json([
                'success' => true,
                'data' => $distribution
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
            // Get distribution based on Word Reading only
            $distribution = $this->calculateWordReadingLevelDistribution('filipino');

            return response()->json([
                'success' => true,
                'data' => $distribution
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

    /**
     * Get English comprehension level distribution by grade
     */
    public function getEnglishComprehensionLevelDistribution()
    {
        try {
            $distribution = $this->calculateComprehensionLevelDistribution('english');

            return response()->json([
                'success' => true,
                'data' => $distribution
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching English comprehension level distribution:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error fetching comprehension distribution: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get Filipino comprehension level distribution by grade
     */
    public function getFilipinoComprehensionLevelDistribution()
    {
        try {
            $distribution = $this->calculateComprehensionLevelDistribution('filipino');

            return response()->json([
                'success' => true,
                'data' => $distribution
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching Filipino comprehension level distribution:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error fetching comprehension distribution: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get comprehension level distribution filtered by grade and section for teachers
     */
    public function getTeacherComprehensionLevelDistribution(Request $request)
    {
        try {
            $grade = $request->input('grade');
            $section = $request->input('section');
            $language = $request->input('language', 'english');

            $distribution = $this->calculateTeacherComprehensionLevelDistribution($language, $grade, $section);

            return response()->json([
                'success' => true,
                'data' => $distribution
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching teacher comprehension level distribution:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error fetching comprehension distribution: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Calculate comprehension level distribution for teachers with section filtering
     */
    private function calculateTeacherComprehensionLevelDistribution($language, $grade = null, $section = null)
    {
        // Get comprehension test results from the appropriate table based on language
        if ($language === 'english') {
            $comprehensionResults = \App\Models\StudentAnswerEnglish::orderBy('created_at', 'desc')
                ->get()
                ->groupBy('student_id')
                ->map(function ($studentResults) {
                    return $studentResults->first(); // Get latest result per student
                });
        } else {
            $comprehensionResults = \App\Models\StudentAnswerTagalog::orderBy('created_at', 'desc')
                ->get()
                ->groupBy('student_id')
                ->map(function ($studentResults) {
                    return $studentResults->first(); // Get latest result per student
                });
        }

        // Get student information to map student_id to grade and section
        $studentsQuery = \App\Models\Student::query();

        if ($grade) {
            $studentsQuery->where('grade_level', $grade);
        }

        if ($section && $section !== 'all') {
            $studentsQuery->where('section', $section);
        }

        $students = $studentsQuery->get()->keyBy('student_number');

        $totalStudents = 0;
        $distribution = [];

        // Initialize distribution for the specific grade or all grades
        if ($grade) {
            $distribution["Grade $grade"] = [
                'Independent' => 0,
                'Instructional' => 0,
                'Frustration' => 0
            ];
        } else {
            for ($g = 7; $g <= 10; $g++) {
                $distribution["Grade $g"] = [
                    'Independent' => 0,
                    'Instructional' => 0,
                    'Frustration' => 0
                ];
            }
        }

        // Calculate distribution by grade
        foreach ($comprehensionResults as $studentId => $result) {
            $student = $students->get($studentId);

            if (!$student) {
                continue; // Skip if student not found or doesn't match filters
            }

            $studentGrade = $student->grade_level;

            // Skip if grade is not in our range
            if ($studentGrade < 7 || $studentGrade > 10) {
                continue;
            }

            // Calculate comprehension percentage
            $totalQuestions = count($result->answers ?? []);
            $comprehensionPercentage = $totalQuestions > 0 ? round(($result->score / $totalQuestions) * 100) : 0;

            // Determine comprehension level
            $level = $this->calculateComprehensionLevel($comprehensionPercentage);

            // Add to distribution
            $distribution["Grade $studentGrade"][$level]++;
            $totalStudents++;
        }

        return [
            'total_students' => $totalStudents,
            'distribution' => $distribution
        ];
    }

    /**
     * Calculate comprehension level distribution based solely on comprehension scores
     * Uses student comprehension test results from StudentAnswerEnglish/StudentAnswerTagalog tables
     */
    private function calculateComprehensionLevelDistribution($language)
    {
        // Get comprehension test results from the appropriate table based on language
        if ($language === 'english') {
            $comprehensionResults = \App\Models\StudentAnswerEnglish::orderBy('created_at', 'desc')
                ->get()
                ->groupBy('student_id')
                ->map(function ($studentResults) {
                    return $studentResults->first(); // Get latest result per student
                });
        } else {
            $comprehensionResults = \App\Models\StudentAnswerTagalog::orderBy('created_at', 'desc')
                ->get()
                ->groupBy('student_id')
                ->map(function ($studentResults) {
                    return $studentResults->first(); // Get latest result per student
                });
        }

        // Get student information to map student_id to grade
        $students = \App\Models\Student::all()->keyBy('student_number');

        $totalStudents = 0;
        $distribution = [];

        // Initialize distribution for all grades
        for ($grade = 7; $grade <= 10; $grade++) {
            $distribution["Grade $grade"] = [
                'Independent' => 0,
                'Instructional' => 0,
                'Frustration' => 0
            ];
        }

        // Calculate distribution by grade
        foreach ($comprehensionResults as $studentId => $result) {
            $student = $students->get($studentId);

            if (!$student) {
                continue; // Skip if student not found
            }

            $grade = $student->grade_level;

            // Skip if grade is not in our range
            if ($grade < 7 || $grade > 10) {
                continue;
            }

            // Calculate comprehension percentage
            $totalQuestions = count($result->answers ?? []);
            $comprehensionPercentage = $totalQuestions > 0 ? round(($result->score / $totalQuestions) * 100) : 0;

            // Determine comprehension level
            $level = $this->calculateComprehensionLevel($comprehensionPercentage);

            // Add to distribution
            $distribution["Grade $grade"][$level]++;
            $totalStudents++;
        }

        return [
            'total_students' => $totalStudents,
            'distribution' => $distribution
        ];
    }

    /**
     * Calculate comprehension level based solely on comprehension score
     *
     * Comprehension Level Criteria:
     * - Independent: 80-100%
     * - Instructional: 59-79%
     * - Frustration: Below 59%
     */
    private function calculateComprehensionLevel($comprehension)
    {
        if ($comprehension >= 80) {
            return 'Independent';
        } elseif ($comprehension >= 59) {
            return 'Instructional';
        } else {
            return 'Frustration';
        }
    }

    /**
     * Calculate word reading level distribution based solely on word reading scores
     */
    private function calculateWordReadingLevelDistribution($language)
    {
        // Get latest assessment per student for the specified language
        $assessments = ReadingAssessment::where('language', $language)
            ->orderBy('assessment_date', 'desc')
            ->get()
            ->groupBy('student_name')
            ->map(function ($studentAssessments) {
                return $studentAssessments->first();
            });

        $totalStudents = $assessments->count();
        $distribution = [];

        // Calculate distribution by grade
        for ($grade = 7; $grade <= 10; $grade++) {
            $gradeAssessments = $assessments->where('grade', $grade);

            $gradeLevels = $gradeAssessments->groupBy(function ($assessment) {
                return $this->calculateWordReadingLevel($assessment->correct_reading);
            });

            $distribution["Grade $grade"] = [
                'Independent' => $gradeLevels->get('Independent', collect())->count(),
                'Instructional' => $gradeLevels->get('Instructional', collect())->count(),
                'Frustration' => $gradeLevels->get('Frustration', collect())->count()
            ];
        }

        return [
            'total_students' => $totalStudents,
            'distribution' => $distribution
        ];
    }

    /**
     * Calculate word reading level distribution by section for each grade
     */
    private function calculateWordReadingLevelDistributionBySection($language)
    {
        // Get latest assessment per student for the specified language
        $assessments = ReadingAssessment::where('language', $language)
            ->orderBy('assessment_date', 'desc')
            ->get()
            ->groupBy('student_name')
            ->map(function ($studentAssessments) {
                return $studentAssessments->first(); // Get latest assessment per student
            });

        $totalStudents = $assessments->count();
        $distribution = [];

        // Get actual sections from the database for each grade
        $actualSections = ReadingAssessment::where('language', $language)
            ->select('grade', 'section')
            ->distinct()
            ->get()
            ->groupBy('grade');

        // Calculate distribution by grade and section using actual data
        foreach ($actualSections as $grade => $gradeSections) {
            $gradeAssessments = $assessments->where('grade', $grade);

            foreach ($gradeSections as $sectionData) {
                $section = $sectionData->section;

                // Use case-insensitive comparison for section matching
                $sectionAssessments = $gradeAssessments->filter(function ($assessment) use ($section) {
                    return strtolower($assessment->section) === strtolower($section);
                });

                $sectionLevels = $sectionAssessments->groupBy(function ($assessment) {
                    return $this->calculateWordReadingLevel($assessment->correct_reading);
                });

                // Only include sections that have data
                if ($sectionAssessments->count() > 0) {
                    $distribution["Grade $grade - $section"] = [
                        'Independent' => $sectionLevels->get('Independent', collect())->count(),
                        'Instructional' => $sectionLevels->get('Instructional', collect())->count(),
                        'Frustration' => $sectionLevels->get('Frustration', collect())->count()
                    ];
                }
            }
        }

        return [
            'total_students' => $totalStudents,
            'distribution' => $distribution
        ];
    }

    /**
     * Calculate comprehension level distribution by section for each grade
     */
    private function calculateComprehensionLevelDistributionBySection($language)
    {
        // Get comprehension results based on language
        if ($language === 'english') {
            $comprehensionResults = \App\Models\StudentAnswerEnglish::orderBy('created_at', 'desc')
                ->get()
                ->groupBy('student_id')
                ->map(function ($studentResults) {
                    return $studentResults->first(); // Get latest result per student
                });
        } else {
            $comprehensionResults = \App\Models\StudentAnswerTagalog::orderBy('created_at', 'desc')
                ->get()
                ->groupBy('student_id')
                ->map(function ($studentResults) {
                    return $studentResults->first(); // Get latest result per student
                });
        }

        // Get student information to map student_id to grade and section
        $students = \App\Models\Student::all()->keyBy('student_number');

        $totalStudents = 0;
        $distribution = [];

        // Get actual grade-section combinations from students who have comprehension data
        $studentsWithData = [];
        foreach ($comprehensionResults as $studentId => $result) {
            $student = $students->get($studentId);
            if ($student && $student->grade_level >= 7 && $student->grade_level <= 10) {
                $studentsWithData[] = $student;
            }
        }

        // Group students by grade and section to get actual combinations
        $actualGradeSections = collect($studentsWithData)
            ->groupBy('grade_level')
            ->map(function ($gradeStudents) {
                return $gradeStudents->pluck('section')->unique()->values();
            });

        // Initialize distribution for actual grade-section combinations
        foreach ($actualGradeSections as $grade => $sections) {
            foreach ($sections as $section) {
                $distribution["Grade $grade - $section"] = [
                    'Independent' => 0,
                    'Instructional' => 0,
                    'Frustration' => 0
                ];
            }
        }

        // Calculate distribution by grade and section
        foreach ($comprehensionResults as $studentId => $result) {
            $student = $students->get($studentId);

            if (!$student) {
                continue; // Skip if student not found
            }

            $grade = $student->grade_level;
            $section = $student->section;

            // Skip if grade is not in our range
            if ($grade < 7 || $grade > 10) {
                continue;
            }

            // Calculate comprehension percentage
            $totalQuestions = count($result->answers ?? []);
            $comprehensionPercentage = $totalQuestions > 0 ? round(($result->score / $totalQuestions) * 100) : 0;

            // Determine comprehension level
            $level = $this->calculateComprehensionLevel($comprehensionPercentage);

            // Add to distribution
            $sectionKey = "Grade $grade - $section";
            if (isset($distribution[$sectionKey])) {
                $distribution[$sectionKey][$level]++;
                $totalStudents++;
            }
        }

        return [
            'total_students' => $totalStudents,
            'distribution' => $distribution
        ];
    }

    /**
     * Calculate word reading level based solely on word reading score
     *
     * Word Reading Level Criteria:
     * - Independent: 97-100%
     * - Instructional: 90-96%
     * - Frustration: Below 90%
     */
    private function calculateWordReadingLevel($wordReading)
    {
        if ($wordReading >= 97) {
            return 'Independent';
        } elseif ($wordReading >= 90) {
            return 'Instructional';
        } else {
            return 'Frustration';
        }
    }

    /**
     * Get English reading level distribution by section
     */
    public function getEnglishReadingLevelDistributionBySection()
    {
        try {
            $distribution = $this->calculateWordReadingLevelDistributionBySection('english');

            return response()->json([
                'success' => true,
                'data' => $distribution
            ]);

        } catch (\Exception $e) {
            Log::error('Error calculating English reading level distribution by section:', [
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
     * Get Filipino reading level distribution by section
     */
    public function getFilipinoReadingLevelDistributionBySection()
    {
        try {
            $distribution = $this->calculateWordReadingLevelDistributionBySection('filipino');

            return response()->json([
                'success' => true,
                'data' => $distribution
            ]);

        } catch (\Exception $e) {
            Log::error('Error calculating Filipino reading level distribution by section:', [
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
     * Get English comprehension level distribution by section
     */
    public function getEnglishComprehensionLevelDistributionBySection()
    {
        try {
            $distribution = $this->calculateComprehensionLevelDistributionBySection('english');

            return response()->json([
                'success' => true,
                'data' => $distribution
            ]);

        } catch (\Exception $e) {
            Log::error('Error calculating English comprehension level distribution by section:', [
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
     * Get Filipino comprehension level distribution by section
     */
    public function getFilipinoComprehensionLevelDistributionBySection()
    {
        try {
            $distribution = $this->calculateComprehensionLevelDistributionBySection('filipino');

            return response()->json([
                'success' => true,
                'data' => $distribution
            ]);

        } catch (\Exception $e) {
            Log::error('Error calculating Filipino comprehension level distribution by section:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error calculating distribution: ' . $e->getMessage()
            ], 500);
        }
    }
}