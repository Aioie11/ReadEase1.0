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
        // Ensure all admin users don't need to change password
        \DB::table('users')
            ->where('role', 'admin')
            ->update([
                'must_change_password' => false,
                'password_changed_at' => now()
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse the changes if needed
        \DB::table('users')
            ->where('role', 'admin')
            ->update([
                'must_change_password' => true,
                'password_changed_at' => null
            ]);
    }
};
