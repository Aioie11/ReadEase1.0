<?php

require_once 'vendor/autoload.php';

// Initialize Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "🔍 Debugging API Data Source...\n\n";

$studentId = '769';
$language = 'english';

// Check all student answer records for this student
echo "📊 All StudentAnswerEnglish Records for Student {$studentId}:\n";
echo str_repeat("=", 80) . "\n";

$allAnswers = \App\Models\StudentAnswerEnglish::where('student_id', $studentId)
    ->orderBy('created_at', 'desc')
    ->get();

foreach ($allAnswers as $index => $answer) {
    echo "Record " . ($index + 1) . " (ID: {$answer->id}):\n";
    echo "   - Created: {$answer->created_at}\n";
    echo "   - Score: {$answer->score}\n";
    echo "   - Answers: " . json_encode($answer->answers, JSON_PRETTY_PRINT) . "\n\n";
}

echo str_repeat("=", 80) . "\n";

// Now let's manually trace what the API is doing
echo "🔍 Manually Tracing API Logic:\n";

// Step 1: Find the student
$student = \App\Models\Student::where('student_number', $studentId)->first();
echo "✅ Student found: {$student->first_name} {$student->last_name}\n";

// Step 2: Get the latest answer (same logic as API)
$answerModel = $language === 'english' ?
    \App\Models\StudentAnswerEnglish::class :
    \App\Models\StudentAnswerTagalog::class;

$latestAnswer = $answerModel::where('student_id', $studentId)
    ->latest('created_at')
    ->first();

echo "✅ Latest Answer Record (ID: {$latestAnswer->id}):\n";
echo "   - Score: {$latestAnswer->score}\n";
echo "   - Answers: " . json_encode($latestAnswer->answers, JSON_PRETTY_PRINT) . "\n\n";

// Step 3: Get reading material and questions (same logic as API)
$readingMaterial = \App\Models\ReadingMaterial::where('subject', $language)
    ->where('is_published', true)
    ->latest('published_at')
    ->first();

$questions = $readingMaterial->questions()->orderBy('id')->get();
echo "✅ Reading Material: {$readingMaterial->title}\n";
echo "✅ Questions Count: {$questions->count()}\n\n";

// Step 4: Process answers (same logic as API)
$answerDetails = [];
$studentAnswers = $latestAnswer->answers ?? [];

echo "🔍 Processing Each Question (API Logic):\n";
echo str_repeat("-", 80) . "\n";

foreach ($questions as $index => $question) {
    $questionNumber = $index + 1;
    $questionKey = 'c' . $questionNumber;
    
    $studentAnswer = $studentAnswers[$questionKey] ?? '';
    $correctAnswer = $question->correct_answer;
    $isCorrect = $studentAnswer == $correctAnswer;
    
    echo "Question {$questionNumber} (Key: {$questionKey}):\n";
    echo "   - Question: {$question->question}\n";
    echo "   - Correct Answer: '{$correctAnswer}'\n";
    echo "   - Student Answer: '{$studentAnswer}'\n";
    echo "   - Is Correct: " . ($isCorrect ? 'YES' : 'NO') . "\n\n";
    
    $answerDetails[] = [
        'question_number' => $questionNumber,
        'question' => $question->question,
        'student_answer' => $studentAnswer,
        'correct_answer' => $correctAnswer,
        'is_correct' => $isCorrect,
        'options' => $question->options ?? []
    ];
}

echo str_repeat("-", 80) . "\n";

// Count correct answers
$correctCount = 0;
foreach ($answerDetails as $detail) {
    if ($detail['is_correct']) $correctCount++;
}

echo "📊 Manual Calculation Results:\n";
echo "   - Correct Count: {$correctCount}/{$questions->count()}\n";
echo "   - Stored Score: {$latestAnswer->score}\n";
echo "   - Match: " . ($correctCount == $latestAnswer->score ? 'YES' : 'NO') . "\n\n";

// Check if there's a ReadingAssessment record
$readingAssessment = \App\Models\ReadingAssessment::where('student_id', $studentId)
    ->where('language', $language)
    ->latest('created_at')
    ->first();

if ($readingAssessment) {
    echo "📊 ReadingAssessment Record:\n";
    echo "   - Correct Answers: {$readingAssessment->correct_answers}\n";
    echo "   - Total Questions: {$readingAssessment->total_questions}\n";
    echo "   - Manual vs Assessment: " . ($correctCount == $readingAssessment->correct_answers ? 'MATCH' : 'MISMATCH') . "\n";
}

echo "\n🎯 Analysis Complete!\n";
