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
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        // Teacher User
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

        

    User::create([
        'name' => 'Test Student',
        'email' => 'test@example.com',
        'password' => Hash::make('test123'),
        'role' => 'student'
    ]);
}

}
