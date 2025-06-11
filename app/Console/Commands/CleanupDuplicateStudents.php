<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;
use App\Models\User;

class CleanupDuplicateStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'students:cleanup-duplicates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up duplicate student records';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting cleanup of duplicate student records...');

        // Find potential duplicates based on name and grade
        $duplicates = Student::selectRaw('first_name, last_name, grade_level, section, COUNT(*) as count')
            ->groupBy('first_name', 'last_name', 'grade_level', 'section')
            ->having('count', '>', 1)
            ->get();

        if ($duplicates->isEmpty()) {
            $this->info('No duplicate students found.');
            return;
        }

        $this->info("Found {$duplicates->count()} sets of duplicate students:");

        foreach ($duplicates as $duplicate) {
            $this->line("- {$duplicate->last_name}, {$duplicate->first_name} (Grade {$duplicate->grade_level}, Section {$duplicate->section}) - {$duplicate->count} records");
        }

        if (!$this->confirm('Do you want to proceed with cleanup?')) {
            $this->info('Cleanup cancelled.');
            return;
        }

        $cleanedCount = 0;

        foreach ($duplicates as $duplicate) {
            // Get all students with this name/grade/section combination
            $students = Student::where('first_name', $duplicate->first_name)
                ->where('last_name', $duplicate->last_name)
                ->where('grade_level', $duplicate->grade_level)
                ->where('section', $duplicate->section)
                ->orderBy('created_at', 'asc')
                ->get();

            if ($students->count() <= 1) {
                continue;
            }

            // Keep the first (oldest) record
            $keepStudent = $students->first();
            $this->info("Keeping student: {$keepStudent->last_name}, {$keepStudent->first_name} (ID: {$keepStudent->id}, Student Number: {$keepStudent->student_number})");

            // Check if there's a corresponding user record for the student we're keeping
            $correspondingUser = User::where('userId', $keepStudent->student_number)->first();
            
            // Remove duplicates
            for ($i = 1; $i < $students->count(); $i++) {
                $duplicateStudent = $students[$i];
                
                // If the duplicate has a corresponding user but the kept one doesn't, 
                // update the kept student's number to match the user
                if (!$correspondingUser) {
                    $duplicateUser = User::where('userId', $duplicateStudent->student_number)->first();
                    if ($duplicateUser) {
                        $this->info("Updating kept student number from {$keepStudent->student_number} to {$duplicateStudent->student_number}");
                        $keepStudent->update(['student_number' => $duplicateStudent->student_number]);
                        $correspondingUser = $duplicateUser;
                    }
                }
                
                $this->info("Removing duplicate: {$duplicateStudent->last_name}, {$duplicateStudent->first_name} (ID: {$duplicateStudent->id}, Student Number: {$duplicateStudent->student_number})");
                $duplicateStudent->delete();
                $cleanedCount++;
            }
        }

        $this->info("Cleanup completed. Removed {$cleanedCount} duplicate student records.");
    }
}
