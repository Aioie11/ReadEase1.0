<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ReadingLevelService;

class UpdateReadingLevels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reading:update-levels';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update reading levels for all assessments that don\'t have one';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating reading levels for existing assessments...');
        
        $readingLevelService = new ReadingLevelService();
        $updated = $readingLevelService->updateMissingReadingLevels();
        
        $this->info("Successfully updated reading levels for {$updated} assessments.");
        
        return Command::SUCCESS;
    }
}
