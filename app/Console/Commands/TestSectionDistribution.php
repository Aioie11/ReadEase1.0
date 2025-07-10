<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ReportsController;

class TestSectionDistribution extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:section-distribution';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test that all sections are included in distribution reports even when they have no data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing Section Distribution Fix');
        $this->info('================================');
        $this->newLine();

        $controller = new ReportsController();

        $expectedSections = [
            7 => ['Narra', 'Dao', 'Mahugani', 'Lawaan'],
            8 => ['Avocado', 'Guava', 'Duhat', 'Mango'],
            9 => ['Gold', 'Silver', 'Zinc'],
            10 => ['Galileo', 'Edison', 'Newton']
        ];

        // Test English reading level distribution by section
        $this->info('Testing English Reading Level Distribution by Section:');
        try {
            $response = $controller->getEnglishReadingLevelDistributionBySection();
            $data = json_decode($response->getContent(), true);

            if ($data['success']) {
                $this->info('✓ API call successful');
                $distribution = $data['data']['distribution'];

                $allSectionsPresent = true;
                foreach ($expectedSections as $grade => $sections) {
                    $this->info("Grade $grade:");
                    foreach ($sections as $section) {
                        $key = "Grade $grade - $section";
                        if (isset($distribution[$key])) {
                            $independent = $distribution[$key]['Independent'];
                            $instructional = $distribution[$key]['Instructional'];
                            $frustration = $distribution[$key]['Frustration'];
                            $total = $independent + $instructional + $frustration;

                            $this->info("  ✓ $section: Independent=$independent, Instructional=$instructional, Frustration=$frustration (Total: $total)");
                        } else {
                            $this->error("  ✗ $section: MISSING from distribution");
                            $allSectionsPresent = false;
                        }
                    }
                }

                if ($allSectionsPresent) {
                    $this->info('✓ All sections are present in English reading distribution');
                } else {
                    $this->error('✗ Some sections are missing from English reading distribution');
                }
            } else {
                $this->error('✗ API call failed: ' . $data['message']);
            }
        } catch (\Exception $e) {
            $this->error('✗ Exception: ' . $e->getMessage());
        }

        $this->newLine();
        $this->info(str_repeat('-', 50));
        $this->newLine();

        // Test Filipino reading level distribution by section
        $this->info('Testing Filipino Reading Level Distribution by Section:');
        try {
            $response = $controller->getFilipinoReadingLevelDistributionBySection();
            $data = json_decode($response->getContent(), true);

            if ($data['success']) {
                $this->info('✓ API call successful');
                $distribution = $data['data']['distribution'];

                $allSectionsPresent = true;
                foreach ($expectedSections as $grade => $sections) {
                    $this->info("Grade $grade:");
                    foreach ($sections as $section) {
                        $key = "Grade $grade - $section";
                        if (isset($distribution[$key])) {
                            $independent = $distribution[$key]['Independent'];
                            $instructional = $distribution[$key]['Instructional'];
                            $frustration = $distribution[$key]['Frustration'];
                            $total = $independent + $instructional + $frustration;

                            $this->info("  ✓ $section: Independent=$independent, Instructional=$instructional, Frustration=$frustration (Total: $total)");
                        } else {
                            $this->error("  ✗ $section: MISSING from distribution");
                            $allSectionsPresent = false;
                        }
                    }
                }

                if ($allSectionsPresent) {
                    $this->info('✓ All sections are present in Filipino reading distribution');
                } else {
                    $this->error('✗ Some sections are missing from Filipino reading distribution');
                }
            } else {
                $this->error('✗ API call failed: ' . $data['message']);
            }
        } catch (\Exception $e) {
            $this->error('✗ Exception: ' . $e->getMessage());
        }

        $this->newLine();
        $this->info('Test completed!');

        return 0;
    }
}
