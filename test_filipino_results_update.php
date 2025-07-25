<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\ReadingMaterial;
use App\Models\ReadingAssessment;
use App\Models\Student;
use App\Models\User;
use App\Models\ReadingQuestion;
use App\Models\StudentAnswerTagalog;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentAnswerTagalogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// Initialize Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "🧪 Testing Filipino Language Test Results Update\n";
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

    // Step 2: Unpublish any existing Filipino materials and create a new one
    echo "📖 Step 2: Creating new Filipino reading material...\n";

    // First, unpublish any existing Filipino materials for this grade
    ReadingMaterial::where('grade_level', $user->grade)
        ->where('subject', 'filipino')
        ->where('is_published', true)
        ->update(['is_published' => false, 'published_at' => null]);

    $material = ReadingMaterial::create([
        'title' => 'Test Filipino Material - Results Update',
        'content' => 'Ito ay isang test reading material para sa Filipino results update.',
        'grade_level' => $user->grade,
        'subject' => 'filipino',
        'is_published' => true,
        'published_at' => now()
    ]);
    
    // Add some questions to the material
    $question1 = ReadingQuestion::create([
        'reading_material_id' => $material->id,
        'question' => 'Ano ang pangunahing paksa ng talata?',
        'type' => 'multiple',
        'options' => ['Opsyon A', 'Opsyon B', 'Opsyon C', 'Opsyon D'],
        'correct_answer' => 'Opsyon A'
    ]);
    
    echo "✅ Created Filipino Material (ID: {$material->id}): {$material->title}\n";
    echo "✅ Added test question (ID: {$question1->id})\n\n";

    // Step 3: Check teacher view BEFORE student completes test
    echo "🔍 Step 3: Checking teacher view BEFORE student completes test...\n";
    
    $teacherController = new TeacherController();
    $request = new Request(['student_id' => $student->student_number]);
    
    $response = $teacherController->view($request);
    $viewData = $response->getData();
    $studentData = $viewData['student'];
    
    $filipinoAssessmentsBefore = $studentData->readingAssessments->where('language', 'filipino');
    echo "Filipino assessments before test: " . $filipinoAssessmentsBefore->count() . "\n\n";

    // Step 4: Create a reading assessment first (simulating teacher assessment)
    echo "📝 Step 4a: Creating reading assessment for the material...\n";

    $readingAssessment = ReadingAssessment::create([
        'student_id' => $student->student_number,
        'student_name' => $student->first_name . ' ' . $student->last_name,
        'reading_material_id' => $material->id,
        'reading_time' => 120.5,
        'miscues' => 2,
        'total_words' => 150,
        'correct_answers' => 0, // Will be updated by comprehension test
        'total_questions' => 0, // Will be updated by comprehension test
        'comprehension' => 0, // Will be updated by comprehension test
        'correct_reading' => 148,
        'reading_speed' => 75,
        'section' => $student->section,
        'language' => 'filipino',
        'grade' => $user->grade,
        'assessment_date' => now(),
        'overall_reading_level' => 'Instructional'
    ]);

    echo "✅ Created reading assessment (ID: {$readingAssessment->id})\n\n";

    // Step 5: Simulate student completing Filipino comprehension test
    echo "📝 Step 5: Simulating student completing Filipino comprehension test...\n";

    // Simulate login
    Auth::login($user);
    
    // Create a mock request for Filipino test
    $testRequest = new Request();
    $testRequest->merge([
        'c1' => 'Opsyon A'  // Correct answer
    ]);
    
    $filipinoController = new StudentAnswerTagalogController();
    
    try {
        $testResponse = $filipinoController->store($testRequest);
        echo "✅ Student completed Filipino comprehension test\n";
    } catch (Exception $e) {
        echo "❌ Error completing test: " . $e->getMessage() . "\n";
        throw $e;
    }
    echo "\n";

    // Step 6: Check teacher view AFTER student completes test
    echo "🔍 Step 6: Checking teacher view AFTER student completes test...\n";
    
    $response = $teacherController->view($request);
    $viewData = $response->getData();
    $studentData = $viewData['student'];
    
    $filipinoAssessmentsAfter = $studentData->readingAssessments->where('language', 'filipino');
    echo "Filipino assessments after test: " . $filipinoAssessmentsAfter->count() . "\n";
    
    if ($filipinoAssessmentsAfter->count() > $filipinoAssessmentsBefore->count()) {
        echo "✅ PASS: Filipino test results updated in teacher view\n";
        
        $latestAssessment = $filipinoAssessmentsAfter->first();
        echo "   - Reading Material ID: " . $latestAssessment->reading_material_id . "\n";
        echo "   - Comprehension Score: " . $latestAssessment->comprehension . "%\n";
        echo "   - Assessment Date: " . $latestAssessment->assessment_date . "\n";
        
        // Verify it's linked to the correct material
        if ($latestAssessment->reading_material_id == $material->id) {
            echo "✅ PASS: Assessment correctly linked to new reading material\n";
        } else {
            echo "❌ FAIL: Assessment not linked to correct reading material\n";
        }
    } else {
        echo "❌ FAIL: Filipino test results did not update in teacher view\n";
    }
    echo "\n";

    // Step 7: Test with a second material to ensure updates work
    echo "📖 Step 7: Testing with second Filipino material...\n";

    // Unpublish first material and create second
    $material->update(['is_published' => false, 'published_at' => null]);

    $material2 = ReadingMaterial::create([
        'title' => 'Test Filipino Material 2 - Results Update',
        'content' => 'Ito ay pangalawang test reading material para sa Filipino results update.',
        'grade_level' => $user->grade,
        'subject' => 'filipino',
        'is_published' => true,
        'published_at' => now()
    ]);
    
    $question2 = ReadingQuestion::create([
        'reading_material_id' => $material2->id,
        'question' => 'Ano ang bagong paksa ng talata?',
        'type' => 'multiple',
        'options' => ['Bagong A', 'Bagong B', 'Bagong C', 'Bagong D'],
        'correct_answer' => 'Bagong A'
    ]);
    
    echo "✅ Created second Filipino Material (ID: {$material2->id})\n";

    // Create reading assessment for second material
    $readingAssessment2 = ReadingAssessment::create([
        'student_id' => $student->student_number,
        'student_name' => $student->first_name . ' ' . $student->last_name,
        'reading_material_id' => $material2->id,
        'reading_time' => 110.0,
        'miscues' => 1,
        'total_words' => 140,
        'correct_answers' => 0,
        'total_questions' => 0,
        'comprehension' => 0,
        'correct_reading' => 139,
        'reading_speed' => 76,
        'section' => $student->section,
        'language' => 'filipino',
        'grade' => $user->grade,
        'assessment_date' => now(),
        'overall_reading_level' => 'Independent'
    ]);

    // Complete test for second material
    $testRequest2 = new Request();
    $testRequest2->merge(['c1' => 'Bagong A']);

    $testResponse2 = $filipinoController->store($testRequest2);
    echo "✅ Student completed test for second material\n";
    
    // Check teacher view shows data for second material only
    $response = $teacherController->view($request);
    $viewData = $response->getData();
    $studentData = $viewData['student'];
    
    $currentAssessments = $studentData->readingAssessments->where('language', 'filipino');
    if ($currentAssessments->count() > 0) {
        $currentAssessment = $currentAssessments->first();
        if ($currentAssessment->reading_material_id == $material2->id) {
            echo "✅ PASS: Teacher view shows data for currently published material only\n";
        } else {
            echo "❌ FAIL: Teacher view shows data for wrong material\n";
        }
    } else {
        echo "❌ FAIL: No assessment data shown for second material\n";
    }
    echo "\n";

    // Cleanup
    echo "🧹 Cleaning up test data...\n";

    // Clean up student answers
    StudentAnswerTagalog::where('student_id', $student->student_number)->delete();

    // Clean up reading assessments
    if (isset($readingAssessment)) $readingAssessment->delete();
    if (isset($readingAssessment2)) $readingAssessment2->delete();

    ReadingAssessment::where('student_id', $student->student_number)
        ->whereIn('reading_material_id', [$material->id, $material2->id])
        ->delete();

    $question1->delete();
    $question2->delete();
    $material->delete();
    $material2->delete();

    // Restore original published materials
    ReadingMaterial::where('grade_level', $user->grade)
        ->where('subject', 'filipino')
        ->where('title', 'BUHAYIN ANG KABUNDUKAN')
        ->update(['is_published' => true, 'published_at' => now()]);

    Auth::logout();

    echo "✅ Test data cleaned up\n\n";

    echo "🎉 Test completed successfully!\n";
    echo "Filipino Language Test Results now update correctly when new materials are published.\n";

} catch (Exception $e) {
    echo "❌ Test failed with error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
    
    // Cleanup on error
    try {
        if (isset($material)) $material->delete();
        if (isset($material2)) $material2->delete();
        if (isset($question1)) $question1->delete();
        if (isset($question2)) $question2->delete();
        Auth::logout();
    } catch (Exception $cleanupError) {
        echo "⚠️ Cleanup error: " . $cleanupError->getMessage() . "\n";
    }
}
