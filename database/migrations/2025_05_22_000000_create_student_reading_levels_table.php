<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('student_reading_levels', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->integer('grade_level');
            $table->enum('reading_level', ['beginner', 'intermediate', 'advanced']);
            $table->string('subject'); // 'english' or 'filipino'
            $table->timestamp('assessment_date');
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('student_id')
                  ->references('student_number')
                  ->on('students')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_reading_levels');
    }
}; 