<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAnswerEnglishTable extends Migration // Class name matches filename convention
{
    public function up()
    {
        Schema::create('student_answer_english', function (Blueprint $table) {
            $table->id();
            $table->string('student_id'); // or $table->unsignedBigInteger('student_id') for foreign key
            $table->string('c1');
            $table->string('c2');
            $table->string('c3');
            $table->string('c4');
            $table->string('c5');
            $table->string('c6');
            $table->string('c7');
            $table->integer('score')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_answer_english');
    }
}
