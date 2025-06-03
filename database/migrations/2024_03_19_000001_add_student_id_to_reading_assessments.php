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
        if (Schema::hasTable('reading_assessments')) {
            Schema::table('reading_assessments', function (Blueprint $table) {
                if (!Schema::hasColumn('reading_assessments', 'student_id')) {
                    $table->string('student_id')->after('id');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reading_assessments', function (Blueprint $table) {
            if (Schema::hasColumn('reading_assessments', 'student_id')) {
                $table->dropColumn('student_id');
            }
        });
    }
}; 