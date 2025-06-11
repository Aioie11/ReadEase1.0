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
        Schema::table('users', function (Blueprint $table) {
            // Add email field if it doesn't exist
            if (!Schema::hasColumn('users', 'email')) {
                $table->string('email')->nullable()->after('name');
            }

            // Add gender field if it doesn't exist
            if (!Schema::hasColumn('users', 'gender')) {
                $table->string('gender')->nullable()->after('section');
            }

            // Add teacherGrade field if it doesn't exist
            if (!Schema::hasColumn('users', 'teacherGrade')) {
                $table->string('teacherGrade')->nullable()->after('gender');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'email')) {
                $table->dropColumn('email');
            }
            if (Schema::hasColumn('users', 'gender')) {
                $table->dropColumn('gender');
            }
            if (Schema::hasColumn('users', 'teacherGrade')) {
                $table->dropColumn('teacherGrade');
            }
        });
    }
};
