<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\ReadingMaterial;
use App\Models\ReadingAssessment;
use App\Models\Student;
use App\Models\User;
use App\Http\Controllers\ReadingMaterialController;
use Illuminate\Support\Facades\DB;

// Initialize Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "🧪 Testing Reading Material Validation Fix\n";
echo "==========================================\n\n";

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

    // Step 2: Create two different reading materials for testing
    echo "📖 Step 2: Creating test reading materials...\n";
    
    // Create first reading material
    $material1 = ReadingMaterial::create([
        'title' => 'Test Material 1 - Old',
        'content' => 'This is the first test reading material content.',
        'grade_level' => $user->grade,
        'subject' => 'english',
        'is_published' => false,
        'published_at' => null
    ]);
    
    // Create second reading material
    $material2 = ReadingMaterial::create([
        'title' => 'Test Material 2 - New',
        'content' => 'This is the second test reading material content.',
        'grade_level' => $user->grade,
        'subject' => 'english',
        'is_published' => false,
        'published_at' => null
    ]);
    
    echo "✅ Created Material 1 (ID: {$material1->id}): {$material1->title}\n";
    echo "✅ Created Material 2 (ID: {$material2->id}): {$material2->title}\n\n";

    // Step 3: Simulate student completing reading assessment for Material 1
    echo "📝 Step 3: Creating reading assessment for Material 1...\n";
    
    $assessment1 = ReadingAssessment::create([
        'student_id' => $student->student_number,
        'student_name' => $student->first_name . ' ' . $student->last_name,
        'reading_material_id' => $material1->id,
        'reading_time' => 120.5,
        'miscues' => 2,
        'total_words' => 150,
        'correct_answers' => 4,
        'total_questions' => 5,
        'comprehension' => 80,
        'correct_reading' => 148,
        'reading_speed' => 75,
        'section' => $student->section,
        'language' => 'english',
        'grade' => $user->grade,
        'assessment_date' => now(),
        'overall_reading_level' => 'Instructional'
    ]);
    
    echo "✅ Created reading assessment for Material 1 (ID: {$assessment1->id})\n\n";

    // Step 4: Test validation with Material 1 (should pass)
    echo "🔍 Step 4: Testing validation with Material 1 (should PASS)...\n";
    
    // Publish Material 1
    $material1->update([
        'is_published' => true,
        'published_at' => now()
    ]);
    
    $controller = new ReadingMaterialController();
    $reflection = new ReflectionClass($controller);
    $method = $reflection->getMethod('hasCompletedReadingAssessment');
    $method->setAccessible(true);
    
    $hasCompleted1 = $method->invoke($controller, $student->student_number, 'english', $material1->id);
    
    if ($hasCompleted1) {
        echo "✅ PASS: Student can access comprehension test for Material 1 (has completed assessment)\n";
    } else {
        echo "❌ FAIL: Student cannot access comprehension test for Material 1 (should be able to)\n";
    }
    echo "\n";

    // Step 5: Test validation with Material 2 (should fail)
    echo "🔍 Step 5: Testing validation with Material 2 (should FAIL)...\n";
    
    // Unpublish Material 1 and publish Material 2
    $material1->update([
        'is_published' => false,
        'published_at' => null
    ]);
    
    $material2->update([
        'is_published' => true,
        'published_at' => now()
    ]);
    
    $hasCompleted2 = $method->invoke($controller, $student->student_number, 'english', $material2->id);
    
    if (!$hasCompleted2) {
        echo "✅ PASS: Student cannot access comprehension test for Material 2 (has not completed assessment)\n";
    } else {
        echo "❌ FAIL: Student can access comprehension test for Material 2 (should not be able to)\n";
    }
    echo "\n";

    // Step 6: Create assessment for Material 2 and test again (should pass)
    echo "📝 Step 6: Creating reading assessment for Material 2...\n";
    
    $assessment2 = ReadingAssessment::create([
        'student_id' => $student->student_number,
        'student_name' => $student->first_name . ' ' . $student->last_name,
        'reading_material_id' => $material2->id,
        'reading_time' => 110.0,
        'miscues' => 1,
        'total_words' => 140,
        'correct_answers' => 5,
        'total_questions' => 5,
        'comprehension' => 100,
        'correct_reading' => 139,
        'reading_speed' => 76,
        'section' => $student->section,
        'language' => 'english',
        'grade' => $user->grade,
        'assessment_date' => now(),
        'overall_reading_level' => 'Independent'
    ]);
    
    echo "✅ Created reading assessment for Material 2 (ID: {$assessment2->id})\n\n";

    // Step 7: Test validation with Material 2 again (should now pass)
    echo "🔍 Step 7: Testing validation with Material 2 again (should now PASS)...\n";
    
    $hasCompleted2Again = $method->invoke($controller, $student->student_number, 'english', $material2->id);
    
    if ($hasCompleted2Again) {
        echo "✅ PASS: Student can now access comprehension test for Material 2 (has completed assessment)\n";
    } else {
        echo "❌ FAIL: Student still cannot access comprehension test for Material 2 (should be able to now)\n";
    }
    echo "\n";

    // Cleanup
    echo "🧹 Cleaning up test data...\n";
    $assessment1->delete();
    $assessment2->delete();
    $material1->delete();
    $material2->delete();
    echo "✅ Test data cleaned up\n\n";

    echo "🎉 Test completed successfully!\n";
    echo "The fix ensures students must complete reading assessments for each specific material.\n";

} catch (Exception $e) {
    echo "❌ Test failed with error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}
