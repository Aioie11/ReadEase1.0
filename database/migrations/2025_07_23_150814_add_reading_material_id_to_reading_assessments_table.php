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
        Schema::table('reading_assessments', function (Blueprint $table) {
            if (!Schema::hasColumn('reading_assessments', 'reading_material_id')) {
                $table->unsignedBigInteger('reading_material_id')->nullable()->after('student_name');
                $table->foreign('reading_material_id')->references('id')->on('reading_materials')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reading_assessments', function (Blueprint $table) {
            if (Schema::hasColumn('reading_assessments', 'reading_material_id')) {
                $table->dropForeign(['reading_material_id']);
                $table->dropColumn('reading_material_id');
            }
        });
    }
};
