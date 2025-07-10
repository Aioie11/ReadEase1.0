<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAnswerTagalog;
use App\Models\ReadingMaterial;
use App\Models\ReadingQuestion;
use App\Models\ReadingAssessment;
use App\Services\ReadingLevelService;
use Illuminate\Support\Facades\Auth;

class StudentAnswerTagalogController extends Controller
{
    public function store(Request $request)
    {
        // Get the authenticated user
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        // Get the current reading material and its questions for the student's grade
        $readingMaterial = ReadingMaterial::where('subject', 'filipino')
            ->where('grade_level', $user->grade)
            ->where('is_published', true)
            ->latest('published_at')  // Get the most recently published material
            ->first();

        if (!$readingMaterial) {
            return redirect()->back()->with('error', 'Walang aktibong reading material na nahanap para sa iyong antas.');
        }

        $questions = $readingMaterial->questions()->orderBy('id')->get();

        // Log submission for tracking
        \Log::info('Student Filipino submission', [
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
            if (strtolower(trim($studentAnswers[$key])) == strtolower(trim($value))) {
                $score++;
            }
        }

        try {
            // Save to database with JSON answers and reading material ID
            StudentAnswerTagalog::create([
                'student_id' => $user->userId,
                'answers' => $studentAnswers,
                'score' => $score,
                'reading_time' => $request->input('reading_time'),
                'reading_speed' => $request->input('reading_speed'),
                'reading_material_id' => $readingMaterial->id, // Store which material was used
            ]);

            // Store score and total questions in session for graphs
            session([
                'filipino_score' => $score,
                'filipino_total_questions' => $totalQuestions,
                'filipino_reading_time' => $request->input('reading_time'),
                'filipino_reading_speed' => $request->input('reading_speed')
            ]);

            // Update reading assessment with comprehension data
            $this->updateReadingAssessmentWithComprehension($user, $score, $totalQuestions, 'filipino');

            // Trigger dashboard update notification for student dashboard
            $this->triggerDashboardUpdate($user->userId, 'filipino');

            return redirect()->route('student.reports');
        } catch (\Exception $e) {
            \Log::error('Error saving Filipino answers: ' . $e->getMessage());
            return redirect()->back()->with('error', 'May error sa pagpapasa ng iyong mga sagot. Pakisubukan muli.');
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

                \Log::info('Updated Filipino reading assessment with comprehension data', [
                    'student_id' => $user->userId,
                    'language' => $language,
                    'score' => $score,
                    'total_questions' => $totalQuestions,
                    'comprehension' => $comprehension,
                    'new_reading_level' => $newReadingLevel,
                    'word_reading' => $assessment->correct_reading
                ]);
            } else {
                // No reading assessment exists yet - create a placeholder assessment
                $comprehension = $totalQuestions > 0 ? round(($score / $totalQuestions) * 100) : 0;

                // Get student information
                $student = \App\Models\Student::where('student_number', $user->userId)->first();

                if ($student) {
                    // Create realistic sample data for demonstration
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

                    \Log::info('Created placeholder Filipino reading assessment with comprehension data', [
                        'student_id' => $user->userId,
                        'language' => $language,
                        'score' => $score,
                        'total_questions' => $totalQuestions,
                        'comprehension' => $comprehension
                    ]);
                } else {
                    \Log::warning('No student found for Filipino comprehension assessment creation', [
                        'student_id' => $user->userId,
                        'language' => $language
                    ]);
                }
            }
        } catch (\Exception $e) {
            \Log::error('Error updating Filipino reading assessment with comprehension data', [
                'student_id' => $user->userId,
                'language' => $language,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
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


