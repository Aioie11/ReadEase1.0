<?php

require_once 'vendor/autoload.php';

// Initialize Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "🔍 Checking Actual Student Answers vs Database...\n\n";

$studentId = '769';

// Get the student answer record
$studentAnswer = \App\Models\StudentAnswerEnglish::where('student_id', $studentId)->first();
if (!$studentAnswer) {
    echo "❌ No student answer found\n";
    exit;
}

// Get the reading assessment record
$assessment = \App\Models\ReadingAssessment::where('student_id', $studentId)
    ->where('language', 'english')
    ->first();

echo "📊 StudentAnswerEnglish Record:\n";
echo "   - Score: {$studentAnswer->score}\n";
echo "   - Answers: " . json_encode($studentAnswer->answers, JSON_PRETTY_PRINT) . "\n\n";

if ($assessment) {
    echo "📊 ReadingAssessment Record:\n";
    echo "   - Correct Answers: {$assessment->correct_answers}\n";
    echo "   - Total Questions: {$assessment->total_questions}\n";
    echo "   - Comprehension: {$assessment->comprehension}%\n\n";
}

// Get the questions and check what the correct answers should be
$readingMaterial = \App\Models\ReadingMaterial::where('subject', 'english')
    ->where('is_published', true)
    ->latest('published_at')
    ->first();

$questions = $readingMaterial->questions()->orderBy('id')->get();

echo "📚 Questions and Expected Answers:\n";
echo str_repeat("=", 80) . "\n";

foreach ($questions as $index => $question) {
    $questionKey = 'c' . ($index + 1);
    $studentAnswerValue = $studentAnswer->answers[$questionKey] ?? 'NOT FOUND';
    
    echo "Question " . ($index + 1) . ":\n";
    echo "  Text: {$question->question}\n";
    echo "  Options: " . json_encode($question->options) . "\n";
    echo "  Correct Answer: '{$question->correct_answer}'\n";
    echo "  Student Answer: '{$studentAnswerValue}'\n";
    
    // Check if student answer matches any of the options
    $isValidOption = false;
    if ($question->options && is_array($question->options)) {
        $isValidOption = in_array($studentAnswerValue, $question->options);
    }
    
    echo "  Valid Option: " . ($isValidOption ? 'YES' : 'NO') . "\n";
    echo "  Match: " . ($studentAnswerValue == $question->correct_answer ? '✅ CORRECT' : '❌ WRONG') . "\n";
    echo "\n";
}

echo str_repeat("=", 80) . "\n";

// Now let's check what the teacher API is actually returning
echo "🔍 Testing Teacher API Response:\n";

try {
    $controller = new \App\Http\Controllers\TeacherController();
    $response = $controller->getStudentComprehensionDetails($studentId, 'english');
    $data = $response->getData(true);
    
    if ($data['success']) {
        echo "✅ API Response successful!\n";
        echo "📊 API Assessment Score: {$data['data']['assessment']['score']}/{$data['data']['assessment']['total_questions']}\n";
        echo "📊 API Percentage: {$data['data']['assessment']['percentage']}%\n\n";
        
        echo "📝 API Answer Details:\n";
        foreach ($data['data']['answer_details'] as $answer) {
            echo "  Q{$answer['question_number']}: " . ($answer['is_correct'] ? '✅ CORRECT' : '❌ WRONG') . "\n";
            echo "    Student: '{$answer['student_answer']}'\n";
            echo "    Correct: '{$answer['correct_answer']}'\n\n";
        }
        
        // Count correct answers from API
        $apiCorrectCount = 0;
        foreach ($data['data']['answer_details'] as $answer) {
            if ($answer['is_correct']) $apiCorrectCount++;
        }
        
        echo "📊 API Calculated Score: {$apiCorrectCount}/" . count($data['data']['answer_details']) . "\n";
        
    } else {
        echo "❌ API Error: {$data['message']}\n";
    }
    
} catch (Exception $e) {
    echo "❌ Exception: " . $e->getMessage() . "\n";
}

echo "\n🎯 Investigation completed!\n";
