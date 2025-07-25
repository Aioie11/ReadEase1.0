<?php

require_once 'vendor/autoload.php';

// Initialize Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\StudentAnswerEnglish;
use App\Models\StudentAnswerTagalog;
use App\Models\ReadingAssessment;
use App\Models\TeacherFeedback;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "🧹 CLEARING ALL STUDENT TEST DATA\n";
echo "=" . str_repeat("=", 50) . "\n";
echo "⚠️  WARNING: This will delete ALL student test records!\n";
echo "   - English comprehension test answers\n";
echo "   - Filipino comprehension test answers\n";
echo "   - Reading assessment records\n";
echo "   - Teacher feedback records\n";
echo "   - Student reading level records\n";
echo "   - Legacy student reading records\n";
echo "\n";
echo "📝 NOTE: Student accounts will NOT be deleted.\n";
echo "=" . str_repeat("=", 50) . "\n\n";

// Ask for confirmation
echo "Are you sure you want to proceed? Type 'YES' to confirm: ";
$handle = fopen("php://stdin", "r");
$confirmation = trim(fgets($handle));
fclose($handle);

if ($confirmation !== 'YES') {
    echo "\n❌ Operation cancelled.\n";
    exit(0);
}

echo "\n🚀 Starting data cleanup...\n\n";

try {
    // Disable foreign key checks temporarily
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    
    $totalDeleted = 0;
    
    // 1. Clear English comprehension test answers
    echo "1️⃣  Clearing English comprehension test answers...\n";
    $englishCount = StudentAnswerEnglish::count();
    if ($englishCount > 0) {
        StudentAnswerEnglish::truncate();
        echo "   ✅ Deleted {$englishCount} English test records\n";
        $totalDeleted += $englishCount;
    } else {
        echo "   ℹ️  No English test records found\n";
    }
    
    // 2. Clear Filipino comprehension test answers
    echo "\n2️⃣  Clearing Filipino comprehension test answers...\n";
    $filipinoCount = StudentAnswerTagalog::count();
    if ($filipinoCount > 0) {
        StudentAnswerTagalog::truncate();
        echo "   ✅ Deleted {$filipinoCount} Filipino test records\n";
        $totalDeleted += $filipinoCount;
    } else {
        echo "   ℹ️  No Filipino test records found\n";
    }
    
    // 3. Clear reading assessments
    echo "\n3️⃣  Clearing reading assessment records...\n";
    $assessmentCount = ReadingAssessment::count();
    if ($assessmentCount > 0) {
        ReadingAssessment::truncate();
        echo "   ✅ Deleted {$assessmentCount} reading assessment records\n";
        $totalDeleted += $assessmentCount;
    } else {
        echo "   ℹ️  No reading assessment records found\n";
    }
    
    // 4. Clear teacher feedback
    echo "\n4️⃣  Clearing teacher feedback records...\n";
    if (Schema::hasTable('teacher_feedback')) {
        $feedbackCount = TeacherFeedback::count();
        if ($feedbackCount > 0) {
            TeacherFeedback::truncate();
            echo "   ✅ Deleted {$feedbackCount} teacher feedback records\n";
            $totalDeleted += $feedbackCount;
        } else {
            echo "   ℹ️  No teacher feedback records found\n";
        }
    } else {
        echo "   ℹ️  Teacher feedback table does not exist\n";
    }
    
    // 5. Clear student reading levels
    echo "\n5️⃣  Clearing student reading level records...\n";
    if (Schema::hasTable('student_reading_levels')) {
        $levelCount = DB::table('student_reading_levels')->count();
        if ($levelCount > 0) {
            DB::table('student_reading_levels')->truncate();
            echo "   ✅ Deleted {$levelCount} student reading level records\n";
            $totalDeleted += $levelCount;
        } else {
            echo "   ℹ️  No student reading level records found\n";
        }
    } else {
        echo "   ℹ️  Student reading levels table does not exist\n";
    }
    
    // 6. Clear legacy student readings
    echo "\n6️⃣  Clearing legacy student reading records...\n";
    if (Schema::hasTable('student_readings')) {
        $legacyCount = DB::table('student_readings')->count();
        if ($legacyCount > 0) {
            DB::table('student_readings')->truncate();
            echo "   ✅ Deleted {$legacyCount} legacy student reading records\n";
            $totalDeleted += $legacyCount;
        } else {
            echo "   ℹ️  No legacy student reading records found\n";
        }
    } else {
        echo "   ℹ️  Student readings table does not exist\n";
    }
    
    // Re-enable foreign key checks
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    
    echo "\n" . str_repeat("=", 50) . "\n";
    echo "✅ CLEANUP COMPLETED SUCCESSFULLY!\n";
    echo "📊 Total records deleted: {$totalDeleted}\n";
    echo "\n📝 Summary:\n";
    echo "   • All student test data has been cleared\n";
    echo "   • Student accounts remain intact\n";
    echo "   • Students can now take fresh assessments\n";
    echo "   • All reports will show no test data\n";
    echo "\n🎯 Your system is now reset and ready for new assessments!\n";
    echo str_repeat("=", 50) . "\n";
    
} catch (Exception $e) {
    // Re-enable foreign key checks in case of error
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    
    echo "\n❌ ERROR: " . $e->getMessage() . "\n";
    echo "🔄 Foreign key checks have been re-enabled.\n";
    echo "⚠️  Some data may have been partially cleared.\n";
    exit(1);
}
