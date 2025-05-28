<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reading_assessments', function (Blueprint $table) {
            $table->integer('correct_answers')->default(0)->after('total_words');
            $table->integer('total_questions')->default(1)->after('correct_answers');
            $table->integer('comprehension')->default(0)->after('total_questions');
            $table->integer('correct_reading')->default(0)->after('comprehension');
            $table->string('grade')->default('7')->after('correct_reading');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reading_assessments', function (Blueprint $table) {
            $table->dropColumn(['correct_answers', 'total_questions', 'comprehension', 'correct_reading', 'grade']);
        });
    }
};
