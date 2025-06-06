<?php

namespace App\Services;

use App\Models\ReadingAssessment;
use App\Models\Student;
use Illuminate\Support\Facades\Log;

class ReadingLevelService
{
    /**
     * Calculate overall reading level based on word reading and comprehension scores
     *
     * OFFICIAL CRITERIA:
     * - Independent: Word Reading ≥ 97% AND Comprehension ≥ 80%
     * - Instructional: Word Reading 90-96% AND Comprehension 59-79%
     * - Frustration: Word Reading < 90% OR Comprehension < 59%
     *
     * SPECIAL HANDLING:
     * - If comprehension is 0 (not completed), use word reading only for preliminary classification
     */
    public function calculateReadingLevel($wordReading, $comprehension)
    {
        // If comprehension data is not available (0), use word reading only for preliminary assessment
        if ($comprehension == 0) {
            if ($wordReading >= 97) {
                return 'Independent'; // Preliminary - needs comprehension confirmation
            } elseif ($wordReading >= 90) {
                return 'Instructional'; // Preliminary - needs comprehension confirmation
            } else {
                return 'Frustration';
            }
        }

        // Apply the full criteria when both scores are available
        if ($wordReading >= 97 && $comprehension >= 80) {
            return 'Independent';
        } elseif ($wordReading >= 90 && $wordReading <= 96 && $comprehension >= 59 && $comprehension <= 79) {
            return 'Instructional';
        } else {
            return 'Frustration';
        }
    }

    /**
     * Update reading level for all assessments that don't have one
     */
    public function updateMissingReadingLevels()
    {
        try {
            $assessmentsWithoutLevel = ReadingAssessment::whereNull('overall_reading_level')->get();
            
            $updated = 0;
            foreach ($assessmentsWithoutLevel as $assessment) {
                $readingLevel = $this->calculateReadingLevel(
                    $assessment->correct_reading,
                    $assessment->comprehension
                );
                
                $assessment->update(['overall_reading_level' => $readingLevel]);
                $updated++;
            }

            Log::info("Updated reading levels for {$updated} assessments");
            return $updated;

        } catch (\Exception $e) {
            Log::error('Error updating missing reading levels:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return 0;
        }
    }

    /**
     * Get reading level distribution for a specific language and grade
     */
    public function getReadingLevelDistribution($language = null, $grade = null)
    {
        try {
            $query = ReadingAssessment::query();
            
            if ($language) {
                $query->where('language', $language);
            }
            
            if ($grade) {
                $query->where('grade', $grade);
            }

            // Get latest assessment per student
            $assessments = $query->orderBy('assessment_date', 'desc')
                ->get()
                ->groupBy('student_name')
                ->map(function ($studentAssessments) {
                    return $studentAssessments->first();
                });

            // Group by grade and reading level
            $distribution = [];
            $assessmentsByGrade = $assessments->groupBy('grade');

            foreach ($assessmentsByGrade as $gradeLevel => $gradeAssessments) {
                $gradeLevels = $gradeAssessments->groupBy(function ($assessment) {
                    // Use stored overall_reading_level if available, otherwise calculate
                    if ($assessment->overall_reading_level) {
                        return $assessment->overall_reading_level;
                    }
                    
                    return $this->calculateReadingLevel(
                        $assessment->correct_reading,
                        $assessment->comprehension
                    );
                });

                $distribution["Grade $gradeLevel"] = [
                    'Independent' => $gradeLevels->get('Independent', collect())->count(),
                    'Instructional' => $gradeLevels->get('Instructional', collect())->count(),
                    'Frustration' => $gradeLevels->get('Frustration', collect())->count()
                ];
            }

            return $distribution;

        } catch (\Exception $e) {
            Log::error('Error calculating reading level distribution:', [
                'language' => $language,
                'grade' => $grade,
                'error' => $e->getMessage()
            ]);
            return [];
        }
    }

    /**
     * Get overall performance summary for a student
     */
    public function getStudentOverallPerformance($studentId)
    {
        try {
            $englishAssessment = ReadingAssessment::where('student_id', $studentId)
                ->where('language', 'english')
                ->latest('assessment_date')
                ->first();

            $filipinoAssessment = ReadingAssessment::where('student_id', $studentId)
                ->where('language', 'filipino')
                ->latest('assessment_date')
                ->first();

            $performance = [
                'student_id' => $studentId,
                'english' => null,
                'filipino' => null,
                'overall_recommendation' => 'No assessments available'
            ];

            if ($englishAssessment) {
                $englishLevel = $englishAssessment->overall_reading_level ?: 
                    $this->calculateReadingLevel($englishAssessment->correct_reading, $englishAssessment->comprehension);
                
                $performance['english'] = [
                    'reading_level' => $englishLevel,
                    'reading_speed' => $englishAssessment->reading_speed,
                    'word_reading' => $englishAssessment->correct_reading,
                    'comprehension' => $englishAssessment->comprehension,
                    'assessment_date' => $englishAssessment->assessment_date
                ];
            }

            if ($filipinoAssessment) {
                $filipinoLevel = $filipinoAssessment->overall_reading_level ?: 
                    $this->calculateReadingLevel($filipinoAssessment->correct_reading, $filipinoAssessment->comprehension);
                
                $performance['filipino'] = [
                    'reading_level' => $filipinoLevel,
                    'reading_speed' => $filipinoAssessment->reading_speed,
                    'word_reading' => $filipinoAssessment->correct_reading,
                    'comprehension' => $filipinoAssessment->comprehension,
                    'assessment_date' => $filipinoAssessment->assessment_date
                ];
            }

            // Determine overall recommendation
            $performance['overall_recommendation'] = $this->determineOverallRecommendation(
                $performance['english']['reading_level'] ?? null,
                $performance['filipino']['reading_level'] ?? null
            );

            return $performance;

        } catch (\Exception $e) {
            Log::error('Error getting student overall performance:', [
                'student_id' => $studentId,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }

    /**
     * Determine overall recommendation based on both language assessments
     */
    private function determineOverallRecommendation($englishLevel, $filipinoLevel)
    {
        if (!$englishLevel && !$filipinoLevel) {
            return 'Complete assessments in both languages';
        }

        if (!$englishLevel) {
            return 'Complete English assessment';
        }

        if (!$filipinoLevel) {
            return 'Complete Filipino assessment';
        }

        // Both assessments available
        $levels = [$englishLevel, $filipinoLevel];
        
        if (in_array('Frustration', $levels)) {
            return 'Needs additional reading support and intervention';
        }
        
        if (in_array('Instructional', $levels)) {
            return 'Continue with guided reading practice';
        }
        
        if (count(array_unique($levels)) === 1 && $levels[0] === 'Independent') {
            return 'Excellent reading performance - ready for advanced materials';
        }

        return 'Continue developing reading skills';
    }

    /**
     * Trigger automatic reading level calculation when assessment is saved
     */
    public function handleAssessmentSaved(ReadingAssessment $assessment)
    {
        try {
            if (!$assessment->overall_reading_level) {
                $readingLevel = $this->calculateReadingLevel(
                    $assessment->correct_reading,
                    $assessment->comprehension
                );
                
                $assessment->update(['overall_reading_level' => $readingLevel]);
                
                Log::info('Automatically calculated reading level for assessment', [
                    'assessment_id' => $assessment->id,
                    'student_name' => $assessment->student_name,
                    'language' => $assessment->language,
                    'reading_level' => $readingLevel
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Error handling assessment saved event:', [
                'assessment_id' => $assessment->id,
                'error' => $e->getMessage()
            ]);
        }
    }
}
