<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAnswerTagalogTable extends Migration // Class name matches filename convention
{
    public function up()
    {
        Schema::create('student_answer_tagalog', function (Blueprint $table) {
            $table->id();
            $table->string('student_id'); // or $table->unsignedBigInteger('student_id') for foreign key
            $table->json('answers'); // Store all answers in a JSON column
            $table->integer('score')->default(0);
            $table->integer('reading_time')->nullable()->comment('Reading time in seconds');
            $table->integer('reading_speed')->nullable()->comment('Reading speed in words per minute');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_answer_tagalog');
    }
}
