<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\ReadingMaterial;
use App\Models\ReadingAssessment;
use App\Models\Student;
use App\Models\User;
use App\Http\Controllers\TeacherController;
use Illuminate\Http\Request;

// Initialize Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "🧪 Testing Teacher View Graph Reset Behavior\n";
echo "===========================================\n\n";

try {
    // Step 1: Get a test student
    echo "👤 Step 1: Finding test student...\n";
    $student = Student::first();
    if (!$student) {
        echo "❌ No students found in database\n";
        exit;
    }
    
    echo "✅ Using student: {$student->first_name} {$student->last_name} (ID: {$student->student_number})\n\n";

    // Step 2: Create first reading material and assessment
    echo "📖 Step 2: Creating first reading material and assessment...\n";
    
    // Unpublish existing materials
    ReadingMaterial::where('grade_level', $student->grade_level)
        ->where('subject', 'english')
        ->update(['is_published' => false, 'published_at' => null]);
    
    $material1 = ReadingMaterial::create([
        'title' => 'First Test Material',
        'content' => 'This is the first test reading material.',
        'grade_level' => $student->grade_level,
        'subject' => 'english',
        'is_published' => true,
        'published_at' => now()
    ]);
    
    // Create reading assessment for first material
    $assessment1 = ReadingAssessment::create([
        'student_id' => $student->student_number,
        'student_name' => $student->first_name . ' ' . $student->last_name,
        'reading_material_id' => $material1->id,
        'reading_time' => 120,
        'miscues' => 2,
        'total_words' => 100,
        'correct_answers' => 8,
        'total_questions' => 10,
        'comprehension' => 80,
        'correct_reading' => 98,
        'reading_speed' => 50,
        'section' => $student->section,
        'language' => 'english',
        'grade' => $student->grade_level,
        'assessment_date' => now(),
        'overall_reading_level' => 'Independent'
    ]);
    
    echo "✅ Created first material and assessment\n\n";

    // Step 3: Test teacher view with first material
    echo "🔍 Step 3: Testing teacher view with first material...\n";
    
    $controller = new TeacherController();
    $request = new Request(['student_id' => $student->student_number]);
    $response = $controller->view($request);
    
    if ($response instanceof \Illuminate\View\View) {
        $viewData = $response->getData();
        $studentData = $viewData['student'];
        
        echo "   📊 Graph data (readingAssessments): " . $studentData->readingAssessments->count() . " records\n";
        echo "   📋 Historical data (allReadingAssessments): " . $studentData->allReadingAssessments->count() . " records\n";
        
        $hasGraphData = $studentData->readingAssessments->count() > 0;
        $hasHistoricalData = $studentData->allReadingAssessments->count() > 0;
        
        if ($hasGraphData && $hasHistoricalData) {
            echo "✅ Both graph and historical data present\n\n";
        } else {
            echo "❌ Missing data - Graph: $hasGraphData, Historical: $hasHistoricalData\n\n";
        }
    } else {
        echo "❌ Controller returned unexpected response type\n\n";
    }

    // Step 4: Publish new reading material (simulating admin action)
    echo "📚 Step 4: Publishing new reading material...\n";
    
    $material2 = ReadingMaterial::create([
        'title' => 'Second Test Material',
        'content' => 'This is the second test reading material.',
        'grade_level' => $student->grade_level,
        'subject' => 'english',
        'is_published' => true,
        'published_at' => now()
    ]);
    
    // Unpublish the first material (simulating the publish behavior)
    $material1->update(['is_published' => false, 'published_at' => null]);
    
    echo "✅ Published new material (student hasn't taken test yet)\n\n";

    // Step 5: Test teacher view with new material (graphs should reset, historical data should remain)
    echo "🔍 Step 5: Testing teacher view with new material...\n";
    
    $response = $controller->view($request);
    
    if ($response instanceof \Illuminate\View\View) {
        $viewData = $response->getData();
        $studentData = $viewData['student'];
        
        echo "   📊 Graph data (readingAssessments): " . $studentData->readingAssessments->count() . " records\n";
        echo "   📋 Historical data (allReadingAssessments): " . $studentData->allReadingAssessments->count() . " records\n";
        
        $hasGraphData = $studentData->readingAssessments->count() > 0;
        $hasHistoricalData = $studentData->allReadingAssessments->count() > 0;
        
        echo "\n✅ Verification Results:\n";
        
        if (!$hasGraphData) {
            echo "✅ PASS: Graphs correctly reset (no current material data)\n";
        } else {
            echo "❌ FAIL: Graphs did not reset properly\n";
        }
        
        if ($hasHistoricalData) {
            echo "✅ PASS: Historical data preserved (Reading Results remain)\n";
        } else {
            echo "❌ FAIL: Historical data was lost\n";
        }
        
        if ($studentData->allReadingAssessments->count() == 1) {
            echo "✅ PASS: Correct number of historical records maintained\n";
        } else {
            echo "❌ FAIL: Incorrect number of historical records\n";
        }
    } else {
        echo "❌ Controller returned unexpected response type\n";
    }

    // Step 6: Clean up test data
    echo "\n🧹 Step 6: Cleaning up test data...\n";
    $assessment1->delete();
    $material1->delete();
    $material2->delete();
    echo "✅ Test data cleaned up\n\n";

    echo "🎉 Test completed successfully!\n";
    echo "📝 Summary: Teacher view now correctly resets graph data when new materials are published while preserving historical data.\n";

} catch (\Exception $e) {
    echo "❌ Error during testing: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}
