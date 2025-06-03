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
        Schema::create('comprehension_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reading_material_id');
            $table->text('question');
            $table->enum('type', ['multiple', 'text'])->default('multiple');
            $table->json('options')->nullable(); // For multiple choice options
            $table->text('correct_answer');
            $table->text('explanation')->nullable();
            $table->integer('order')->default(1);
            $table->timestamps();

            $table->foreign('reading_material_id')->references('id')->on('reading_materials')->onDelete('cascade');
            $table->index(['reading_material_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comprehension_questions');
    }
};
