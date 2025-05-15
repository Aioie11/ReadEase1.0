<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reading_assessments', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->float('reading_time');
            $table->integer('miscues');
            $table->integer('total_words');
            $table->integer('reading_speed');
            $table->string('section');
            $table->string('language');
            $table->timestamp('assessment_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reading_assessments');
    }
}; 