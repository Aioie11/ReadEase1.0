<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Test Teacher',
            'email' => 'teacher@example.com',
            'password' => Hash::make('password123'),
            'role' => 'teacher'
        ]);

        // Student User
User::create([
    'name' => 'Test Student',
    'email' => 'student@example.com',
    'password' => Hash::make('student123'),
    'role' => 'student'
]);
    }
} 


