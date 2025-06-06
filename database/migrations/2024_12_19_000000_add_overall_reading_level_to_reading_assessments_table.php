<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reading_assessments', function (Blueprint $table) {
            $table->enum('overall_reading_level', ['Independent', 'Instructional', 'Frustration'])
                  ->nullable()
                  ->after('grade')
                  ->comment('Overall reading performance level calculated from word reading and comprehension');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reading_assessments', function (Blueprint $table) {
            $table->dropColumn('overall_reading_level');
        });
    }
};
