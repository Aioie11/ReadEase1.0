<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reading_data', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->integer('reading_time');
            $table->integer('total_words');
            $table->string('reading_speed');
            $table->integer('correct_answers');
            $table->integer('total_questions');
            $table->string('comprehension');
            $table->integer('word_recognition');
            $table->string('word_label');
            $table->integer('miscues');
            $table->string('section');
            $table->string('language');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reading_data');
    }
}; 