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
        Schema::table('student_answer_tagalog', function (Blueprint $table) {
            // Check if columns don't exist before adding them
            if (!Schema::hasColumn('student_answer_tagalog', 'reading_time')) {
                $table->integer('reading_time')->nullable()->comment('Reading time in seconds')->after('score');
            }
            if (!Schema::hasColumn('student_answer_tagalog', 'reading_speed')) {
                $table->integer('reading_speed')->nullable()->comment('Reading speed in words per minute')->after('reading_time');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_answer_tagalog', function (Blueprint $table) {
            $table->dropColumn(['reading_time', 'reading_speed']);
        });
    }
};
