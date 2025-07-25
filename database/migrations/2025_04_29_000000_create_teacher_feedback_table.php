<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('teacher_feedback', function (Blueprint $table) {
            $table->id();
            $table->string('student_id'); // References student_number from students table
            $table->string('teacher_id'); // References user ID of teacher
            $table->string('teacher_name');
            $table->string('language'); // 'english' or 'filipino'
            $table->integer('grade_level');
            $table->string('section');
            $table->unsignedBigInteger('reading_material_id')->nullable(); // References reading_materials table
            $table->text('strengths')->nullable();
            $table->text('areas_for_improvement')->nullable();
            $table->text('recommendations')->nullable();
            $table->boolean('is_sent')->default(false);
            $table->timestamp('sent_at')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('reading_material_id')->references('id')->on('reading_materials')->onDelete('set null');

            // Add foreign key constraint
            $table->foreign('student_id')
                  ->references('student_number')
                  ->on('students')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('teacher_feedback');
    }
};
