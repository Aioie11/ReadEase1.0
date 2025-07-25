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
        Schema::table('teacher_feedback', function (Blueprint $table) {
            $table->unsignedBigInteger('reading_material_id')->nullable()->after('section');
            
            // Add foreign key constraint
            $table->foreign('reading_material_id')->references('id')->on('reading_materials')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teacher_feedback', function (Blueprint $table) {
            $table->dropForeign(['reading_material_id']);
            $table->dropColumn('reading_material_id');
        });
    }
};
