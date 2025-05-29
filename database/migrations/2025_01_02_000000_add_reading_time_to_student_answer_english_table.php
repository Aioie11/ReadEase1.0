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
        Schema::table('student_answer_english', function (Blueprint $table) {
            $table->integer('reading_time')->nullable()->after('score')->comment('Reading time in seconds');
            $table->integer('reading_speed')->nullable()->after('reading_time')->comment('Reading speed in words per minute');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_answer_english', function (Blueprint $table) {
            $table->dropColumn(['reading_time', 'reading_speed']);
        });
    }
};
