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

echo "🧹 Cleaning up orphaned test records from deleted students...\n";
echo "=" . str_repeat("=", 60) . "\n\n";

try {
    // Get all existing student IDs from both users and students tables
    echo "📊 Step 1: Finding existing students...\n";
    
    $existingStudentIds = collect();
    
    // Get student IDs from users table (active accounts)
    $userStudentIds = DB::table('users')
        ->where('role', 'student')
        ->pluck('userId');
    $existingStudentIds = $existingStudentIds->merge($userStudentIds);
    
    // Get student numbers from students table
    $studentNumbers = DB::table('students')
        ->pluck('student_number');
    $existingStudentIds = $existingStudentIds->merge($studentNumbers);
    
    // Remove duplicates
    $existingStudentIds = $existingStudentIds->unique();

    echo "   Found {$existingStudentIds->count()} existing students\n";
    echo "   Student IDs: " . $existingStudentIds->take(10)->implode(', ') . 
         ($existingStudentIds->count() > 10 ? '...' : '') . "\n\n";

    // Check current test counts
    echo "📈 Step 2: Current test record counts...\n";
    $englishCount = StudentAnswerEnglish::count();
    $filipinoCount = StudentAnswerTagalog::count();
    $readingCount = ReadingAssessment::count();
    
    echo "   English tests: {$englishCount}\n";
    echo "   Filipino tests: {$filipinoCount}\n";
    echo "   Reading assessments: {$readingCount}\n";
    echo "   Total tests: " . ($englishCount + $filipinoCount + $readingCount) . "\n\n";

    // Find orphaned records
    echo "🔍 Step 3: Finding orphaned records...\n";
    
    $orphanedEnglish = StudentAnswerEnglish::whereNotIn('student_id', $existingStudentIds)->get();
    $orphanedFilipino = StudentAnswerTagalog::whereNotIn('student_id', $existingStudentIds)->get();
    $orphanedReading = ReadingAssessment::whereNotIn('student_id', $existingStudentIds)->get();
    
    echo "   Orphaned English tests: {$orphanedEnglish->count()}\n";
    echo "   Orphaned Filipino tests: {$orphanedFilipino->count()}\n";
    echo "   Orphaned Reading assessments: {$orphanedReading->count()}\n";
    
    $totalOrphaned = $orphanedEnglish->count() + $orphanedFilipino->count() + $orphanedReading->count();
    echo "   Total orphaned records: {$totalOrphaned}\n\n";

    if ($totalOrphaned == 0) {
        echo "✨ No orphaned records found. Database is already clean!\n";
        exit(0);
    }

    // Show details of orphaned records
    echo "📋 Step 4: Orphaned record details...\n";
    
    if ($orphanedEnglish->count() > 0) {
        echo "   English test orphans:\n";
        foreach ($orphanedEnglish as $record) {
            echo "     - ID: {$record->id}, Student: {$record->student_id}, Score: {$record->score}, Date: {$record->created_at}\n";
        }
    }
    
    if ($orphanedFilipino->count() > 0) {
        echo "   Filipino test orphans:\n";
        foreach ($orphanedFilipino as $record) {
            echo "     - ID: {$record->id}, Student: {$record->student_id}, Score: {$record->score}, Date: {$record->created_at}\n";
        }
    }
    
    if ($orphanedReading->count() > 0) {
        echo "   Reading assessment orphans:\n";
        foreach ($orphanedReading as $record) {
            echo "     - ID: {$record->id}, Student: {$record->student_id}, Name: {$record->student_name}, Date: {$record->created_at}\n";
        }
    }
    
    echo "\n";

    // Confirm deletion
    echo "⚠️  WARNING: This will permanently delete {$totalOrphaned} orphaned test records.\n";
    echo "Do you want to proceed? (y/N): ";
    $handle = fopen("php://stdin", "r");
    $line = fgets($handle);
    fclose($handle);
    
    if (trim(strtolower($line)) !== 'y') {
        echo "❌ Operation cancelled.\n";
        exit(0);
    }

    // Delete orphaned records
    echo "\n🗑️  Step 5: Deleting orphaned records...\n";
    
    // Disable foreign key checks temporarily
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    
    $deletedCount = 0;
    
    // Delete orphaned English tests
    if ($orphanedEnglish->count() > 0) {
        StudentAnswerEnglish::whereNotIn('student_id', $existingStudentIds)->delete();
        echo "   ✅ Deleted {$orphanedEnglish->count()} orphaned English test records\n";
        $deletedCount += $orphanedEnglish->count();
    }
    
    // Delete orphaned Filipino tests
    if ($orphanedFilipino->count() > 0) {
        StudentAnswerTagalog::whereNotIn('student_id', $existingStudentIds)->delete();
        echo "   ✅ Deleted {$orphanedFilipino->count()} orphaned Filipino test records\n";
        $deletedCount += $orphanedFilipino->count();
    }
    
    // Delete orphaned Reading assessments
    if ($orphanedReading->count() > 0) {
        ReadingAssessment::whereNotIn('student_id', $existingStudentIds)->delete();
        echo "   ✅ Deleted {$orphanedReading->count()} orphaned Reading assessment records\n";
        $deletedCount += $orphanedReading->count();
    }
    
    // Also clean up teacher feedback if it exists
    if (Schema::hasTable('teacher_feedback')) {
        $orphanedFeedback = DB::table('teacher_feedback')
            ->whereNotIn('student_id', $existingStudentIds)
            ->count();
        
        if ($orphanedFeedback > 0) {
            DB::table('teacher_feedback')
                ->whereNotIn('student_id', $existingStudentIds)
                ->delete();
            echo "   ✅ Deleted {$orphanedFeedback} orphaned teacher feedback records\n";
            $deletedCount += $orphanedFeedback;
        }
    }
    
    // Re-enable foreign key checks
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    
    // Show final counts
    echo "\n📊 Step 6: Final test record counts...\n";
    $newEnglishCount = StudentAnswerEnglish::count();
    $newFilipinoCount = StudentAnswerTagalog::count();
    $newReadingCount = ReadingAssessment::count();
    
    echo "   English tests: {$newEnglishCount} (was {$englishCount})\n";
    echo "   Filipino tests: {$newFilipinoCount} (was {$filipinoCount})\n";
    echo "   Reading assessments: {$newReadingCount} (was {$readingCount})\n";
    echo "   Total tests: " . ($newEnglishCount + $newFilipinoCount + $newReadingCount) . 
         " (was " . ($englishCount + $filipinoCount + $readingCount) . ")\n\n";

    echo "🎉 Successfully deleted {$deletedCount} orphaned test records!\n";
    echo "📚 Database is now clean of orphaned test data.\n";

} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
    exit(1);
}
