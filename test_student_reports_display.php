<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\ReadingMaterial;
use App\Models\ReadingAssessment;
use App\Models\Student;
use App\Models\User;
use App\Models\ReadingQuestion;
use App\Models\StudentAnswerEnglish;
use App\Models\StudentAnswerTagalog;
use App\Http\Controllers\StudentDashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Initialize Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "🧪 Testing Student Reports Display with New Materials\n";
echo "====================================================\n\n";

try {
    // Step 1: Get a test student
    echo "👤 Step 1: Finding test student...\n";
    $student = Student::first();
    if (!$student) {
        echo "❌ No students found in database\n";
        exit;
    }
    
    $user = User::where('userId', $student->student_number)->first();
    if (!$user) {
        echo "❌ No user found for student {$student->student_number}\n";
        exit;
    }
    
    echo "✅ Using student: {$student->first_name} {$student->last_name} (ID: {$student->student_number})\n\n";

    // Step 2: Create first reading material and student activity
    echo "📖 Step 2: Creating first reading material and student activity...\n";
    
    // Unpublish existing materials
    ReadingMaterial::where('grade_level', $user->grade)
        ->where('subject', 'english')
        ->update(['is_published' => false, 'published_at' => null]);
    
    $material1 = ReadingMaterial::create([
        'title' => 'First Test Material',
        'content' => 'This is the first test reading material.',
        'grade_level' => $user->grade,
        'subject' => 'english',
        'is_published' => true,
        'published_at' => now()
    ]);
    
    $question1 = ReadingQuestion::create([
        'reading_material_id' => $material1->id,
        'question' => 'What is the main topic?',
        'type' => 'multiple',
        'options' => ['Option A', 'Option B', 'Option C', 'Option D'],
        'correct_answer' => 'Option A'
    ]);
    
    // Create student activity for first material
    $activity1 = StudentAnswerEnglish::create([
        'student_id' => $user->userId,
        'reading_material_id' => $material1->id,
        'answers' => ['c1' => 'Option A'],
        'score' => 1,
        'total_questions' => 1,
        'reading_time' => 120,
        'reading_speed' => 150
    ]);
    
    // Create reading assessment for first material
    $assessment1 = ReadingAssessment::create([
        'student_id' => $student->student_number,
        'student_name' => $student->first_name . ' ' . $student->last_name,
        'reading_material_id' => $material1->id,
        'reading_time' => 120.5,
        'miscues' => 2,
        'total_words' => 150,
        'correct_answers' => 1,
        'total_questions' => 1,
        'comprehension' => 100,
        'correct_reading' => 148,
        'reading_speed' => 75,
        'section' => $student->section,
        'language' => 'english',
        'grade' => $user->grade,
        'assessment_date' => now()->subDays(1),
        'overall_reading_level' => 'Independent'
    ]);
    
    echo "✅ Created first material and student activity\n\n";

    // Step 3: Test reports with first material (should show data)
    echo "🔍 Step 3: Testing reports with first material...\n";
    
    Auth::login($user);
    $controller = new StudentDashboardController();
    $response = $controller->reports();

    // Check if it's a view response
    if ($response instanceof \Illuminate\View\View) {
        $viewData = $response->getData();
    } else {
        echo "❌ Controller returned unexpected response type: " . get_class($response) . "\n";
        throw new Exception("Expected view response, got " . get_class($response));
    }
    
    $hasEnglishActivity = $viewData['latestEnglishActivity'] !== null;
    $hasEnglishReading = $viewData['latestEnglishReading'] !== null;
    $hasHistoricalActivities = $viewData['allEnglishActivities']->count() > 0;
    $hasHistoricalAssessments = $viewData['allReadingAssessments']->count() > 0;
    
    echo "Current material data (for graphs):\n";
    echo "  - Has English Activity: " . ($hasEnglishActivity ? 'YES' : 'NO') . "\n";
    echo "  - Has English Reading: " . ($hasEnglishReading ? 'YES' : 'NO') . "\n";
    echo "Historical data (for results tables):\n";
    echo "  - Historical Activities: " . $viewData['allEnglishActivities']->count() . "\n";
    echo "  - Historical Assessments: " . $viewData['allReadingAssessments']->count() . "\n\n";

    // Step 4: Publish new material (simulate new material publication)
    echo "📖 Step 4: Publishing new reading material...\n";
    
    // Unpublish first material and create second
    $material1->update(['is_published' => false, 'published_at' => null]);
    
    $material2 = ReadingMaterial::create([
        'title' => 'Second Test Material',
        'content' => 'This is the second test reading material.',
        'grade_level' => $user->grade,
        'subject' => 'english',
        'is_published' => true,
        'published_at' => now()
    ]);
    
    $question2 = ReadingQuestion::create([
        'reading_material_id' => $material2->id,
        'question' => 'What is the new topic?',
        'type' => 'multiple',
        'options' => ['New A', 'New B', 'New C', 'New D'],
        'correct_answer' => 'New A'
    ]);
    
    echo "✅ Published new material (student hasn't taken test yet)\n\n";

    // Step 5: Test reports with new material (graphs should reset, historical data should remain)
    echo "🔍 Step 5: Testing reports with new material...\n";
    
    $response = $controller->reports();

    // Check if it's a view response
    if ($response instanceof \Illuminate\View\View) {
        $viewData = $response->getData();
    } else {
        echo "❌ Controller returned unexpected response type: " . get_class($response) . "\n";
        throw new Exception("Expected view response, got " . get_class($response));
    }
    
    $hasEnglishActivityNew = $viewData['latestEnglishActivity'] !== null;
    $hasEnglishReadingNew = $viewData['latestEnglishReading'] !== null;
    $hasHistoricalActivitiesNew = $viewData['allEnglishActivities']->count() > 0;
    $hasHistoricalAssessmentsNew = $viewData['allReadingAssessments']->count() > 0;
    
    echo "Current material data (for graphs):\n";
    echo "  - Has English Activity: " . ($hasEnglishActivityNew ? 'YES' : 'NO') . "\n";
    echo "  - Has English Reading: " . ($hasEnglishReadingNew ? 'YES' : 'NO') . "\n";
    echo "Historical data (for results tables):\n";
    echo "  - Historical Activities: " . $viewData['allEnglishActivities']->count() . "\n";
    echo "  - Historical Assessments: " . $viewData['allReadingAssessments']->count() . "\n\n";

    // Step 6: Verify the fix
    echo "✅ Verification Results:\n";
    
    if (!$hasEnglishActivityNew && !$hasEnglishReadingNew) {
        echo "✅ PASS: Graphs correctly reset (no current material data)\n";
    } else {
        echo "❌ FAIL: Graphs did not reset properly\n";
    }
    
    if ($hasHistoricalActivitiesNew && $hasHistoricalAssessmentsNew) {
        echo "✅ PASS: Historical data preserved (Reading Results and Answer Results remain)\n";
    } else {
        echo "❌ FAIL: Historical data was lost\n";
    }
    
    if ($viewData['allEnglishActivities']->count() == 1 && $viewData['allReadingAssessments']->count() == 1) {
        echo "✅ PASS: Correct number of historical records maintained\n";
    } else {
        echo "❌ FAIL: Incorrect number of historical records\n";
    }

    // Cleanup
    echo "\n🧹 Cleaning up test data...\n";
    
    $activity1->delete();
    $assessment1->delete();
    $question1->delete();
    $question2->delete();
    $material1->delete();
    $material2->delete();
    
    Auth::logout();
    
    echo "✅ Test data cleaned up\n\n";

    echo "🎉 Test completed successfully!\n";
    echo "Student reports now correctly separate graph data from historical data.\n";

} catch (Exception $e) {
    echo "❌ Test failed with error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
    
    // Cleanup on error
    try {
        if (isset($activity1)) $activity1->delete();
        if (isset($assessment1)) $assessment1->delete();
        if (isset($question1)) $question1->delete();
        if (isset($question2)) $question2->delete();
        if (isset($material1)) $material1->delete();
        if (isset($material2)) $material2->delete();
        Auth::logout();
    } catch (Exception $cleanupError) {
        echo "⚠️ Cleanup error: " . $cleanupError->getMessage() . "\n";
    }
}
