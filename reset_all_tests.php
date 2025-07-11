<?php

require_once 'vendor/autoload.php';

// Initialize Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\StudentAnswerEnglish;
use App\Models\StudentAnswerTagalog;
use App\Models\ReadingAssessment;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "🗑️  Reset All Test Records\n";
echo "=" . str_repeat("=", 40) . "\n\n";

// Show current state
echo "📊 Current Database State:\n";
$englishCount = StudentAnswerEnglish::count();
$filipinoCount = StudentAnswerTagalog::count();
$readingCount = ReadingAssessment::count();
$totalTests = $englishCount + $filipinoCount + $readingCount;

echo "   English tests: {$englishCount}\n";
echo "   Filipino tests: {$filipinoCount}\n";
echo "   Reading assessments: {$readingCount}\n";
echo "   Total tests: {$totalTests}\n";
echo "   Total students: " . Student::count() . "\n\n";

if ($totalTests == 0) {
    echo "✨ No test records found. Database is already clean!\n";
    exit(0);
}

// Show what will be deleted
echo "📋 Test Records to be Deleted:\n";

if ($englishCount > 0) {
    echo "   English Tests:\n";
    $englishTests = StudentAnswerEnglish::all();
    foreach ($englishTests as $test) {
        $student = Student::where('student_number', $test->student_id)->first();
        $studentName = $student ? "{$student->last_name}, {$student->first_name}" : "Unknown Student (ID: {$test->student_id})";
        echo "     - ID: {$test->id}, Student: {$studentName}, Score: {$test->score}, Date: {$test->created_at}\n";
    }
}

if ($filipinoCount > 0) {
    echo "   Filipino Tests:\n";
    $filipinoTests = StudentAnswerTagalog::all();
    foreach ($filipinoTests as $test) {
        $student = Student::where('student_number', $test->student_id)->first();
        $studentName = $student ? "{$student->last_name}, {$student->first_name}" : "Unknown Student (ID: {$test->student_id})";
        echo "     - ID: {$test->id}, Student: {$studentName}, Score: {$test->score}, Date: {$test->created_at}\n";
    }
}

if ($readingCount > 0) {
    echo "   Reading Assessments:\n";
    $readingTests = ReadingAssessment::all();
    foreach ($readingTests as $test) {
        $student = Student::where('student_number', $test->student_id)->first();
        $studentName = $student ? "{$student->last_name}, {$student->first_name}" : $test->student_name;
        echo "     - ID: {$test->id}, Student: {$studentName}, Language: {$test->language}, Date: {$test->created_at}\n";
    }
}

echo "\n⚠️  WARNING: This will permanently delete ALL {$totalTests} test records.\n";
echo "This will reset the total test count to 0.\n";
echo "Students will remain in the database, but all their test data will be removed.\n\n";

echo "Do you want to proceed? (y/N): ";
$handle = fopen("php://stdin", "r");
$line = fgets($handle);
fclose($handle);

if (trim(strtolower($line)) !== 'y') {
    echo "❌ Operation cancelled.\n";
    exit(0);
}

echo "\n🗑️  Deleting all test records...\n";

try {
    // Disable foreign key checks temporarily
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    
    $deletedCount = 0;
    
    // Delete teacher feedback first (has foreign key to reading_assessments)
    if (Schema::hasTable('teacher_feedback')) {
        $feedbackCount = DB::table('teacher_feedback')->count();
        if ($feedbackCount > 0) {
            DB::table('teacher_feedback')->delete();
            echo "   ✅ Deleted {$feedbackCount} teacher feedback records\n";
            $deletedCount += $feedbackCount;
        }
    }
    
    // Delete reading assessments
    if ($readingCount > 0) {
        ReadingAssessment::query()->delete();
        echo "   ✅ Deleted {$readingCount} reading assessment records\n";
        $deletedCount += $readingCount;
    }
    
    // Delete English comprehension answers
    if ($englishCount > 0) {
        StudentAnswerEnglish::query()->delete();
        echo "   ✅ Deleted {$englishCount} English comprehension answer records\n";
        $deletedCount += $englishCount;
    }
    
    // Delete Filipino comprehension answers
    if ($filipinoCount > 0) {
        StudentAnswerTagalog::query()->delete();
        echo "   ✅ Deleted {$filipinoCount} Filipino comprehension answer records\n";
        $deletedCount += $filipinoCount;
    }
    
    // Delete student reading levels if exists
    if (Schema::hasTable('student_reading_levels')) {
        $levelCount = DB::table('student_reading_levels')->count();
        if ($levelCount > 0) {
            DB::table('student_reading_levels')->delete();
            echo "   ✅ Deleted {$levelCount} student reading level records\n";
            $deletedCount += $levelCount;
        }
    }
    
    // Delete student readings if exists
    if (Schema::hasTable('student_readings')) {
        $studentReadingCount = DB::table('student_readings')->count();
        if ($studentReadingCount > 0) {
            DB::table('student_readings')->delete();
            echo "   ✅ Deleted {$studentReadingCount} student reading records\n";
            $deletedCount += $studentReadingCount;
        }
    }
    
    // Re-enable foreign key checks
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    
    // Show final state
    echo "\n📊 Final Database State:\n";
    $newEnglishCount = StudentAnswerEnglish::count();
    $newFilipinoCount = StudentAnswerTagalog::count();
    $newReadingCount = ReadingAssessment::count();
    $newTotalTests = $newEnglishCount + $newFilipinoCount + $newReadingCount;
    
    echo "   English tests: {$newEnglishCount}\n";
    echo "   Filipino tests: {$newFilipinoCount}\n";
    echo "   Reading assessments: {$newReadingCount}\n";
    echo "   Total tests: {$newTotalTests}\n";
    echo "   Total students: " . Student::count() . " (unchanged)\n\n";
    
    echo "🎉 Successfully deleted {$deletedCount} total records!\n";
    echo "📚 All test data has been cleared. Total test count is now 0.\n";
    echo "🧪 Students remain in the database and can take new assessments.\n";

} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
    exit(1);
}
