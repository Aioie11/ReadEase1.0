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
        // Add total_questions to student_answer_english table
        Schema::table('student_answer_english', function (Blueprint $table) {
            if (!Schema::hasColumn('student_answer_english', 'total_questions')) {
                $table->integer('total_questions')->default(0)->after('score')->comment('Total number of questions in the assessment');
            }
        });

        // Add total_questions to student_answer_tagalog table
        Schema::table('student_answer_tagalog', function (Blueprint $table) {
            if (!Schema::hasColumn('student_answer_tagalog', 'total_questions')) {
                $table->integer('total_questions')->default(0)->after('score')->comment('Total number of questions in the assessment');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_answer_english', function (Blueprint $table) {
            if (Schema::hasColumn('student_answer_english', 'total_questions')) {
                $table->dropColumn('total_questions');
            }
        });

        Schema::table('student_answer_tagalog', function (Blueprint $table) {
            if (Schema::hasColumn('student_answer_tagalog', 'total_questions')) {
                $table->dropColumn('total_questions');
            }
        });
    }
};
