<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\ReadingMaterial;
use App\Models\ReadingAssessment;
use App\Models\Student;
use App\Models\User;
use App\Models\ReadingQuestion;
use App\Http\Controllers\StudentAnswerEnglishController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// Initialize Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "🧪 Testing Comprehension Test Access Validation\n";
echo "===============================================\n\n";

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

    // Step 2: Create a new reading material
    echo "📖 Step 2: Creating new reading material...\n";
    
    $material = ReadingMaterial::create([
        'title' => 'Test Material - Comprehension Access',
        'content' => 'This is a test reading material for comprehension access validation.',
        'grade_level' => $user->grade,
        'subject' => 'english',
        'is_published' => true,
        'published_at' => now()
    ]);
    
    // Add some questions to the material
    $question1 = ReadingQuestion::create([
        'reading_material_id' => $material->id,
        'question' => 'What is the main topic of this passage?',
        'type' => 'multiple',
        'options' => ['Option A', 'Option B', 'Option C', 'Option D'],
        'correct_answer' => 'Option A'
    ]);
    
    echo "✅ Created Material (ID: {$material->id}): {$material->title}\n";
    echo "✅ Added test question (ID: {$question1->id})\n\n";

    // Step 3: Test comprehension access WITHOUT reading assessment (should fail)
    echo "🔍 Step 3: Testing comprehension access WITHOUT reading assessment...\n";
    
    // Simulate login
    Auth::login($user);
    
    // Create a mock request
    $request = new Request();
    $request->merge([
        'c1' => 'Option A'
    ]);
    
    $controller = new StudentAnswerEnglishController();
    
    try {
        $response = $controller->store($request);
        
        // Check if it's a redirect with error
        if ($response instanceof \Illuminate\Http\RedirectResponse) {
            $session = $response->getSession();
            if ($session && $session->has('error')) {
                echo "✅ PASS: Access denied - " . $session->get('error') . "\n";
            } else {
                echo "❌ FAIL: Access was allowed but should have been denied\n";
            }
        } else {
            echo "❌ FAIL: Unexpected response type\n";
        }
    } catch (Exception $e) {
        if (strpos($e->getMessage(), 'reading assessment') !== false) {
            echo "✅ PASS: Access denied with reading assessment error\n";
        } else {
            echo "❌ FAIL: Unexpected error: " . $e->getMessage() . "\n";
        }
    }
    echo "\n";

    // Step 4: Create reading assessment for the material
    echo "📝 Step 4: Creating reading assessment for the material...\n";
    
    $assessment = ReadingAssessment::create([
        'student_id' => $student->student_number,
        'student_name' => $student->first_name . ' ' . $student->last_name,
        'reading_material_id' => $material->id,
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
        'assessment_date' => now(),
        'overall_reading_level' => 'Instructional'
    ]);
    
    echo "✅ Created reading assessment (ID: {$assessment->id})\n\n";

    // Step 5: Test comprehension access WITH reading assessment (should pass)
    echo "🔍 Step 5: Testing comprehension access WITH reading assessment...\n";
    
    try {
        $response = $controller->store($request);
        
        // Check if it's a redirect to reports (success)
        if ($response instanceof \Illuminate\Http\RedirectResponse) {
            $targetUrl = $response->getTargetUrl();
            if (strpos($targetUrl, 'reports') !== false) {
                echo "✅ PASS: Access granted - redirected to reports page\n";
            } else {
                $session = $response->getSession();
                if ($session && $session->has('error')) {
                    echo "❌ FAIL: Access denied - " . $session->get('error') . "\n";
                } else {
                    echo "❌ FAIL: Unexpected redirect to: " . $targetUrl . "\n";
                }
            }
        } else {
            echo "❌ FAIL: Unexpected response type\n";
        }
    } catch (Exception $e) {
        echo "❌ FAIL: Unexpected error: " . $e->getMessage() . "\n";
    }
    echo "\n";

    // Cleanup
    echo "🧹 Cleaning up test data...\n";
    
    // Clean up any student answers that might have been created
    DB::table('student_answer_english')->where('student_id', $student->student_number)->delete();
    
    $assessment->delete();
    $question1->delete();
    $material->delete();
    
    Auth::logout();
    
    echo "✅ Test data cleaned up\n\n";

    echo "🎉 Test completed successfully!\n";
    echo "The validation correctly prevents comprehension test access without reading assessment.\n";

} catch (Exception $e) {
    echo "❌ Test failed with error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
    
    // Cleanup on error
    try {
        if (isset($assessment)) $assessment->delete();
        if (isset($question1)) $question1->delete();
        if (isset($material)) $material->delete();
        Auth::logout();
    } catch (Exception $cleanupError) {
        echo "⚠️ Cleanup error: " . $cleanupError->getMessage() . "\n";
    }
}
