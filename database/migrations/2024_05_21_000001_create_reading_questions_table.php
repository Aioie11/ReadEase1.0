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
        Schema::create('reading_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reading_material_id')->constrained()->onDelete('cascade');
            $table->text('question');
            $table->string('type');
            $table->json('options')->nullable();
            $table->string('correct_answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reading_questions');
    }
}; 