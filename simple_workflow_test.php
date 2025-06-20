<?php

require 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\StudentAnswerEnglish;
use App\Models\Student;
use App\Models\ReadingMaterial;

echo "🎯 Simple Student Comprehension Workflow Test\n";
echo "=" . str_repeat("=", 50) . "\n\n";

// Get test student
$student = Student::first();
echo "📚 Student: {$student->first_name} {$student->last_name} (ID: {$student->student_number})\n\n";

// Get English reading material
$englishMaterial = ReadingMaterial::where('subject', 'english')->first();
if ($englishMaterial) {
    echo "📖 Reading Material: {$englishMaterial->title}\n";
    echo "📝 Questions available: {$englishMaterial->comprehensionQuestions->count()}\n\n";
} else {
    echo "❌ No English reading material found\n";
    exit;
}

// Create test student answers
echo "✍️ Creating test student answers...\n";

$testAnswers = [
    'c1' => 'In a small town by the mountains',
    'c2' => 'Her grandmother and grandfather', 
    'c3' => 'Washing dishes and taking care of animals',
    'c4' => 'Stories about nature',
    'c5' => 'To become a teacher'
];

$studentAnswer = StudentAnswerEnglish::create([
    'student_id' => $student->student_number,
    'answers' => $testAnswers,
    'score' => 5,
    'reading_time' => 120,
    'reading_speed' => 150
]);

echo "✅ Student answers created with ID: {$studentAnswer->id}\n";
echo "📊 Score: 5/5 (100%)\n\n";

// Test the teacher API
echo "👩‍🏫 Testing teacher comprehension details API...\n";
try {
    $controller = new \App\Http\Controllers\TeacherController();
    $response = $controller->getStudentComprehensionDetails($student->student_number, 'english');
    
    $responseData = $response->getData(true);
    
    if ($responseData['success']) {
        echo "✅ API Success!\n";
        echo "   Student: " . $responseData['data']['student']['name'] . "\n";
        echo "   Score: " . $responseData['data']['assessment']['score'] . "/" . $responseData['data']['assessment']['total_questions'] . "\n";
        echo "   Percentage: " . $responseData['data']['assessment']['percentage'] . "%\n";
        echo "   Questions: " . count($responseData['data']['answer_details']) . "\n\n";
        
        // Show answer details
        echo "📋 Answer Details:\n";
        foreach ($responseData['data']['answer_details'] as $answer) {
            $status = $answer['is_correct'] ? '✅' : '❌';
            echo "   Q{$answer['question_number']}: {$status} {$answer['student_answer']}\n";
        }
    } else {
        echo "❌ API Error: " . $responseData['message'] . "\n";
    }
} catch (Exception $e) {
    echo "❌ Exception: " . $e->getMessage() . "\n";
}

echo "\n" . str_repeat("=", 50) . "\n";
echo "🎉 Test Complete!\n\n";

echo "🌐 Test URLs:\n";
echo "- Student answers: http://localhost:8000/debug/student-answers\n";
echo "- Comprehension API: http://localhost:8000/debug/comprehension/{$student->student_number}/english\n";
echo "- Teacher view: http://localhost:8000/teacher/view/{$student->student_number}\n\n";

echo "📋 Manual Testing Steps:\n";
echo "1. 👩‍🏫 Login as teacher\n";
echo "2. 📊 Go to Student Management\n";
echo "3. 👀 Click 'View' for {$student->first_name} {$student->last_name}\n";
echo "4. 🔍 Click 'View Details' in Language Test Results\n";
echo "5. ✅ Verify modal shows student answers\n";
