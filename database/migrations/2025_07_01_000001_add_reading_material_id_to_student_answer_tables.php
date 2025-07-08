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
        // Add reading_material_id to student_answer_english table
        Schema::table('student_answer_english', function (Blueprint $table) {
            if (!Schema::hasColumn('student_answer_english', 'reading_material_id')) {
                $table->unsignedBigInteger('reading_material_id')->nullable()->after('student_id');
                $table->foreign('reading_material_id')->references('id')->on('reading_materials')->onDelete('set null');
            }
        });

        // Add reading_material_id to student_answer_tagalog table
        Schema::table('student_answer_tagalog', function (Blueprint $table) {
            if (!Schema::hasColumn('student_answer_tagalog', 'reading_material_id')) {
                $table->unsignedBigInteger('reading_material_id')->nullable()->after('student_id');
                $table->foreign('reading_material_id')->references('id')->on('reading_materials')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_answer_english', function (Blueprint $table) {
            if (Schema::hasColumn('student_answer_english', 'reading_material_id')) {
                $table->dropForeign(['reading_material_id']);
                $table->dropColumn('reading_material_id');
            }
        });

        Schema::table('student_answer_tagalog', function (Blueprint $table) {
            if (Schema::hasColumn('student_answer_tagalog', 'reading_material_id')) {
                $table->dropForeign(['reading_material_id']);
                $table->dropColumn('reading_material_id');
            }
        });
    }
};
