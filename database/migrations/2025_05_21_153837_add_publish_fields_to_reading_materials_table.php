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
        Schema::table('reading_materials', function (Blueprint $table) {
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reading_materials', function (Blueprint $table) {
            $table->dropColumn(['is_published', 'published_at']);
        });
    }
};
