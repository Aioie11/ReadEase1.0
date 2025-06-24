<?php

require_once 'vendor/autoload.php';

// Initialize Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "🔍 Debugging Question-Answer Mismatch...\n\n";

// Get a student with answers
$studentAnswer = \App\Models\StudentAnswerEnglish::first();
if (!$studentAnswer) {
    echo "❌ No student answers found\n";
    exit;
}

echo "📊 Student ID: {$studentAnswer->student_id}\n";
echo "📊 Student Answers: " . json_encode($studentAnswer->answers, JSON_PRETTY_PRINT) . "\n\n";

// Get the reading material and questions
$readingMaterial = \App\Models\ReadingMaterial::where('subject', 'english')
    ->where('is_published', true)
    ->latest('published_at')
    ->first();

if (!$readingMaterial) {
    echo "❌ No reading material found\n";
    exit;
}

echo "📚 Reading Material: {$readingMaterial->title}\n\n";

// Test different question ordering methods
echo "🔍 Testing Question Ordering Methods:\n";
echo str_repeat("=", 80) . "\n";

// Method 1: Student submission order (orderBy('id'))
$questionsById = $readingMaterial->questions()->orderBy('id')->get();
echo "Method 1 - Student Submission Order (orderBy('id')):\n";
foreach ($questionsById as $index => $question) {
    $questionKey = 'c' . ($index + 1);
    $studentAnswerValue = $studentAnswer->answers[$questionKey] ?? 'NOT FOUND';
    echo "  Q" . ($index + 1) . " (ID: {$question->id}): {$question->question}\n";
    echo "    Correct: {$question->correct_answer}\n";
    echo "    Student ({$questionKey}): {$studentAnswerValue}\n";
    echo "    Match: " . ($studentAnswerValue == $question->correct_answer ? '✅ YES' : '❌ NO') . "\n\n";
}

echo str_repeat("-", 80) . "\n";

// Method 2: Teacher viewing order (no specific order)
$questionsDefault = $readingMaterial->questions()->get();
echo "Method 2 - Teacher Viewing Order (no orderBy):\n";
foreach ($questionsDefault as $index => $question) {
    $questionKey = 'c' . ($index + 1);
    $studentAnswerValue = $studentAnswer->answers[$questionKey] ?? 'NOT FOUND';
    echo "  Q" . ($index + 1) . " (ID: {$question->id}): {$question->question}\n";
    echo "    Correct: {$question->correct_answer}\n";
    echo "    Student ({$questionKey}): {$studentAnswerValue}\n";
    echo "    Match: " . ($studentAnswerValue == $question->correct_answer ? '✅ YES' : '❌ NO') . "\n\n";
}

echo str_repeat("-", 80) . "\n";

// Method 3: Alternative ordering
$questionsByCreated = $readingMaterial->questions()->orderBy('created_at')->get();
echo "Method 3 - Created Order (orderBy('created_at')):\n";
foreach ($questionsByCreated as $index => $question) {
    $questionKey = 'c' . ($index + 1);
    $studentAnswerValue = $studentAnswer->answers[$questionKey] ?? 'NOT FOUND';
    echo "  Q" . ($index + 1) . " (ID: {$question->id}): {$question->question}\n";
    echo "    Correct: {$question->correct_answer}\n";
    echo "    Student ({$questionKey}): {$studentAnswerValue}\n";
    echo "    Match: " . ($studentAnswerValue == $question->correct_answer ? '✅ YES' : '❌ NO') . "\n\n";
}

echo str_repeat("=", 80) . "\n";

// Calculate scores for each method
$score1 = 0;
$score2 = 0;
$score3 = 0;

foreach ($questionsById as $index => $question) {
    $questionKey = 'c' . ($index + 1);
    $studentAnswerValue = $studentAnswer->answers[$questionKey] ?? '';
    if ($studentAnswerValue == $question->correct_answer)
        $score1++;
}

foreach ($questionsDefault as $index => $question) {
    $questionKey = 'c' . ($index + 1);
    $studentAnswerValue = $studentAnswer->answers[$questionKey] ?? '';
    if ($studentAnswerValue == $question->correct_answer)
        $score2++;
}

foreach ($questionsByCreated as $index => $question) {
    $questionKey = 'c' . ($index + 1);
    $studentAnswerValue = $studentAnswer->answers[$questionKey] ?? '';
    if ($studentAnswerValue == $question->correct_answer)
        $score3++;
}

echo "📊 Score Comparison:\n";
echo "   - Method 1 (orderBy('id')): {$score1}/{$questionsById->count()}\n";
echo "   - Method 2 (no orderBy): {$score2}/{$questionsDefault->count()}\n";
echo "   - Method 3 (orderBy('created_at')): {$score3}/{$questionsByCreated->count()}\n";
echo "   - Stored Score: {$studentAnswer->score}\n\n";

echo "🎯 Analysis:\n";
if ($score1 == $studentAnswer->score) {
    echo "✅ Method 1 (orderBy('id')) matches stored score - This is the correct ordering!\n";
} elseif ($score2 == $studentAnswer->score) {
    echo "✅ Method 2 (no orderBy) matches stored score - This is the correct ordering!\n";
} elseif ($score3 == $studentAnswer->score) {
    echo "✅ Method 3 (orderBy('created_at')) matches stored score - This is the correct ordering!\n";
} else {
    echo "❌ None of the methods match the stored score - There's a deeper issue!\n";
}

echo "\n🔧 Recommendation: Use the method that matches the stored score in the teacher controller.\n";
