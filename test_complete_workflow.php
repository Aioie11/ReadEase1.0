<?php

require 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\StudentAnswerEnglish;
use App\Models\StudentAnswerTagalog;
use App\Models\Student;
use App\Models\ReadingAssessment;
use App\Models\ReadingMaterial;
use App\Models\ComprehensionQuestion;

echo "🎯 Testing Complete Student-to-Teacher Assessment Workflow\n";
echo "=" . str_repeat("=", 60) . "\n\n";

// Step 1: Get a test student
echo "📚 Step 1: Finding test student...\n";
$student = Student::first();
if (!$student) {
    echo "❌ No students found in database\n";
    exit;
}
echo "✅ Using student: {$student->first_name} {$student->last_name} (ID: {$student->student_number})\n\n";

// Step 2: Check if reading material and questions exist
echo "📖 Step 2: Checking reading materials and questions...\n";
$englishMaterial = ReadingMaterial::where('subject', 'english')->where('is_published', true)->first();
$englishQuestions = $englishMaterial ? $englishMaterial->comprehensionQuestions : collect();

if (!$englishMaterial) {
    echo "❌ No English reading material found\n";
    exit;
}
if ($englishQuestions->count() == 0) {
    echo "❌ No English comprehension questions found\n";
    exit;
}

echo "✅ English reading material: {$englishMaterial->title}\n";
echo "✅ English questions available: {$englishQuestions->count()}\n\n";

// Step 3: Simulate student answering comprehension questions
echo "✍️ Step 3: Simulating student comprehension submission...\n";

// Create realistic test answers
$testAnswers = [];
$correctCount = 0;
foreach ($englishQuestions->take(5) as $index => $question) {
    $questionKey = 'c' . ($index + 1);

    // Simulate some correct and some incorrect answers
    if ($index < 3) {
        // First 3 answers are correct
        $testAnswers[$questionKey] = $question->correct_answer;
        $correctCount++;
    } else {
        // Last 2 answers are incorrect
        $testAnswers[$questionKey] = "Student's incorrect answer " . ($index + 1);
    }
}

// Create student answer record
$studentAnswer = StudentAnswerEnglish::create([
    'student_id' => $student->student_number,
    'answers' => $testAnswers,
    'score' => $correctCount,
    'reading_time' => 120,
    'reading_speed' => 150
]);

echo "✅ Student answers submitted successfully!\n";
echo "   - Score: {$correctCount}/{$englishQuestions->take(5)->count()}\n";
echo "   - Answers: " . json_encode($testAnswers, JSON_PRETTY_PRINT) . "\n\n";

// Step 4: Test the placeholder assessment creation
echo "🔄 Step 4: Testing placeholder assessment creation...\n";
$assessment = ReadingAssessment::where('student_id', $student->student_number)
    ->where('language', 'english')
    ->first();

if ($assessment) {
    echo "✅ Reading assessment record created/updated:\n";
    echo "   - Student: {$assessment->student_name}\n";
    echo "   - Language: {$assessment->language}\n";
    echo "   - Comprehension: {$assessment->comprehension}%\n";
    echo "   - Correct Answers: {$assessment->correct_answers}/{$assessment->total_questions}\n";
    echo "   - Reading Speed: {$assessment->reading_speed} WPM (placeholder)\n\n";
} else {
    echo "❌ No reading assessment record found\n\n";
}

// Step 5: Test teacher's comprehension details API
echo "👩‍🏫 Step 5: Testing teacher's comprehension details API...\n";
try {
    $controller = new \App\Http\Controllers\TeacherController();
    $response = $controller->getStudentComprehensionDetails($student->student_number, 'english');

    $responseData = $response->getData(true);

    if ($responseData['success']) {
        echo "✅ Teacher API working successfully!\n";
        echo "   - Student: " . $responseData['data']['student']['name'] . "\n";
        echo "   - Score: " . $responseData['data']['assessment']['score'] . "/" . $responseData['data']['assessment']['total_questions'] . "\n";
        echo "   - Percentage: " . $responseData['data']['assessment']['percentage'] . "%\n";
        echo "   - Answer details: " . count($responseData['data']['answer_details']) . " questions\n";

        // Show first answer detail as example
        if (!empty($responseData['data']['answer_details'])) {
            $firstAnswer = $responseData['data']['answer_details'][0];
            echo "   - Example Q1: " . ($firstAnswer['is_correct'] ? '✅ Correct' : '❌ Incorrect') . "\n";
        }
    } else {
        echo "❌ Teacher API failed: " . $responseData['message'] . "\n";
    }
} catch (Exception $e) {
    echo "❌ Error testing teacher API: " . $e->getMessage() . "\n";
}

echo "\n" . str_repeat("=", 60) . "\n";
echo "🎉 Workflow Test Complete!\n\n";

echo "📋 Next Steps for Manual Testing:\n";
echo "1. 🧑‍🎓 Log in as student (ID: {$student->student_number})\n";
echo "2. 📖 Go to English reading section\n";
echo "3. ✍️ Answer comprehension questions and submit\n";
echo "4. 👩‍🏫 Log in as teacher\n";
echo "5. 📊 Go to Student Management\n";
echo "6. 👀 Click 'View' for {$student->first_name} {$student->last_name}\n";
echo "7. 🔍 Click 'View Details' button in Language Test Results\n";
echo "8. ✅ Verify comprehension details modal shows correct/incorrect answers\n\n";

echo "🌐 Test URLs:\n";
echo "- Debug student answers: http://localhost:8000/debug/student-answers\n";
echo "- Debug comprehension API: http://localhost:8000/debug/comprehension/{$student->student_number}/english\n";
echo "- Teacher view student: http://localhost:8000/teacher/view/{$student->student_number}\n";
