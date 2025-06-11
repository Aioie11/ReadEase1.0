<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'userId' => 'admin123',
            'name' => 'Administrator',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'must_change_password' => false,
            'password_changed_at' => now()
        ]);
    }
}
