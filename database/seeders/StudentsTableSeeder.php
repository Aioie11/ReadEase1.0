<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Illuminate\Support\Str;

class StudentsTableSeeder extends Seeder
{
    public function run()
    {
        Student::create([
            'student_number' => 'STD-' . Str::random(8),
            'first_name' => 'Alexander',
            'last_name' => 'Albiniga',
            'middle_name' => 'V.A.',
            'gender' => 'Male',
            'grade_level' => 7,
            'section' => 'Narra'
        ]);

        Student::create([
            'student_number' => 'STD-' . Str::random(8),
            'first_name' => 'Juan',
            'last_name' => 'Dela Cruz',
            'middle_name' => 'P.',
            'gender' => 'Male',
            'grade_level' => 7,
            'section' => 'Narra'
        ]);

        Student::create([
            'student_number' => 'STD-' . Str::random(8),
            'first_name' => 'Maria',
            'last_name' => 'Santos',
            'middle_name' => 'L.',
            'gender' => 'Female',
            'grade_level' => 7,
            'section' => 'Narra'
        ]);
    }
} 