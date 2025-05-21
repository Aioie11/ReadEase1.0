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
        // Admin User
        User::create([
            'name' => 'Admin User',
            'userId' => 'ADMIN123',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        // Teacher User
        User::create([
            'name' => 'Test Teacher',
            'userId' => 'TCH456',
            'password' => Hash::make('password123'),
            'role' => 'teacher'
        ]);

        // Student User
        User::create([
            'name' => 'Test Student',
            'userId' => 'STU789',
            'password' => Hash::make('student123'),
            'role' => 'student'
        ]);
    }
}
