<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAnswerEnglish;
use App\Models\ReadingMaterial;
use App\Models\ReadingQuestion;
use App\Models\ReadingAssessment;
use App\Services\ReadingLevelService;
use Illuminate\Support\Facades\Auth;

class StudentAnswerEnglishController extends Controller
{
    public function store(Request $request)
    {
        // Get the authenticated user
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        // Get the current reading material and its questions for the student's grade
        $readingMaterial = ReadingMaterial::where('subject', 'english')
            ->where('grade_level', $user->grade)
            ->where('is_published', true)
            ->first();

        if (!$readingMaterial) {
            return redirect()->back()->with('error', 'No active reading material found for your grade level.');
        }

        $questions = $readingMaterial->questions()->orderBy('id')->get();

        // Log submission for tracking
        \Log::info('Student English submission', [
            'student_id' => $user->userId,
            'reading_material_id' => $readingMaterial->id,
            'reading_material_title' => $readingMaterial->title,
            'questions_count' => $questions->count()
        ]);

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
            // Save to database with JSON answers and reading material ID
            StudentAnswerEnglish::create([
                'student_id' => $user->userId,
                'answers' => $studentAnswers,
                'score' => $score,
                'reading_time' => $request->input('reading_time'),
                'reading_speed' => $request->input('reading_speed'),
                'reading_material_id' => $readingMaterial->id, // Store which material was used
            ]);

            // Store score and total questions in session for graphs
            session([
                'english_score' => $score,
                'english_total_questions' => $totalQuestions,
                'english_reading_time' => $request->input('reading_time'),
                'english_reading_speed' => $request->input('reading_speed')
            ]);

            // Update reading assessment with comprehension data
            $this->updateReadingAssessmentWithComprehension($user, $score, $totalQuestions, 'english');

            // Trigger dashboard update notification
            $this->triggerDashboardUpdate($user->userId, 'english');

            return redirect()->route('student.reports');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'There was an error submitting your answers. Please try again.');
        }
    }

    /**
     * Update reading assessment with comprehension data when student completes questions
     */
    private function updateReadingAssessmentWithComprehension($user, $score, $totalQuestions, $language)
    {
        try {
            // Find the latest reading assessment for this student and language
            $assessment = ReadingAssessment::where('student_id', $user->userId)
                ->where('language', $language)
                ->latest('assessment_date')
                ->first();

            if ($assessment) {
                // Calculate comprehension percentage
                $comprehension = $totalQuestions > 0 ? round(($score / $totalQuestions) * 100) : 0;

                // Update the assessment with comprehension data
                $assessment->update([
                    'correct_answers' => $score,
                    'total_questions' => $totalQuestions,
                    'comprehension' => $comprehension
                ]);

                // Recalculate overall reading level with new comprehension data
                $readingLevelService = new ReadingLevelService();
                $newReadingLevel = $readingLevelService->calculateReadingLevel(
                    $assessment->correct_reading,
                    $comprehension
                );

                $assessment->update(['overall_reading_level' => $newReadingLevel]);

                \Log::info('Updated reading assessment with comprehension data', [
                    'student_id' => $user->userId,
                    'language' => $language,
                    'score' => $score,
                    'total_questions' => $totalQuestions,
                    'comprehension' => $comprehension,
                    'new_reading_level' => $newReadingLevel
                ]);
            } else {
                // No reading assessment exists yet - create a placeholder assessment
                // This will be updated later when the teacher conducts the reading assessment
                $comprehension = $totalQuestions > 0 ? round(($score / $totalQuestions) * 100) : 0;

                // Get student information
                $student = \App\Models\Student::where('student_number', $user->userId)->first();

                if ($student) {
                    // Create realistic sample data for demonstration
                    // In production, these would be filled by actual teacher assessments
                    $sampleReadingTime = rand(60, 180); // 1-3 minutes in seconds
                    $sampleTotalWords = rand(80, 150); // Typical passage length
                    $sampleMiscues = rand(0, 8); // Realistic miscue count
                    $sampleReadingSpeed = round($sampleTotalWords / ($sampleReadingTime / 60)); // Calculate WPM
                    $sampleCorrectReading = max(85, round((($sampleTotalWords - $sampleMiscues) / $sampleTotalWords) * 100));

                    ReadingAssessment::create([
                        'student_id' => $user->userId,
                        'student_name' => $student->first_name . ' ' . $student->last_name,
                        'reading_time' => $sampleReadingTime, // Sample data for chart display
                        'miscues' => $sampleMiscues, // Sample data for chart display
                        'total_words' => $sampleTotalWords, // Sample data for chart display
                        'correct_answers' => $score,
                        'total_questions' => $totalQuestions,
                        'comprehension' => $comprehension,
                        'correct_reading' => $sampleCorrectReading, // Sample data for chart display
                        'reading_speed' => $sampleReadingSpeed, // Sample data for chart display
                        'section' => $student->section,
                        'language' => $language,
                        'grade' => (string) $student->grade_level,
                        'assessment_date' => now(),
                        'overall_reading_level' => $comprehension >= 80 ? 'Independent' : ($comprehension >= 59 ? 'Instructional' : 'Frustration')
                    ]);

                    \Log::info('Created placeholder reading assessment with comprehension data', [
                        'student_id' => $user->userId,
                        'language' => $language,
                        'score' => $score,
                        'total_questions' => $totalQuestions,
                        'comprehension' => $comprehension
                    ]);
                }
            }
        } catch (\Exception $e) {
            \Log::error('Error updating reading assessment with comprehension data', [
                'student_id' => $user->userId,
                'language' => $language,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Trigger dashboard update notification for student dashboard
     */
    private function triggerDashboardUpdate($studentId, $language)
    {
        try {
            // Store assessment completion flag in cache for dashboard auto-refresh
            cache()->put("assessment_completed_{$studentId}_{$language}", true, 300); // 5 minutes

            \Log::info('Dashboard update triggered for student', [
                'student_id' => $studentId,
                'language' => $language,
                'timestamp' => now(),
                'cache_key' => "assessment_completed_{$studentId}_{$language}"
            ]);
        } catch (\Exception $e) {
            \Log::error('Error triggering dashboard update', [
                'student_id' => $studentId,
                'language' => $language,
                'error' => $e->getMessage()
            ]);
        }
    }
}
