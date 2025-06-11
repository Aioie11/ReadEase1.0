<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User (existing user, no password change required)
        User::create([
            'name' => 'Admin User',
            'userId' => 'ADMIN123',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'must_change_password' => false,
            'password_changed_at' => now()
        ]);

        // Teacher User (existing user, no password change required)
        User::create([
            'name' => 'Test Teacher',
            'userId' => 'TECH123',
            'password' => Hash::make('tech123'),
            'role' => 'teacher',
            'must_change_password' => false,
            'password_changed_at' => now()
        ]);

        // Student User (existing user, no password change required)
        User::create([
            'name' => 'Test Student',
            'userId' => 'STUD123',
            'password' => Hash::make('stud123'),
            'role' => 'student',
            'must_change_password' => false,
            'password_changed_at' => now()
        ]);
    }
}
