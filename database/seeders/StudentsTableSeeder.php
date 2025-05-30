<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Illuminate\Support\Str;

class StudentsTableSeeder extends Seeder
{
    public function run()
    {
        // Grade 7 - Narra Section
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

        Student::create([
            'student_number' => 'STD-' . Str::random(8),
            'first_name' => 'Emma',
            'last_name' => 'Brown',
            'middle_name' => 'R.',
            'gender' => 'Female',
            'grade_level' => 7,
            'section' => 'Narra'
        ]);

        Student::create([
            'student_number' => 'STD-' . Str::random(8),
            'first_name' => 'Carlos',
            'last_name' => 'Mendoza',
            'middle_name' => 'A.',
            'gender' => 'Male',
            'grade_level' => 7,
            'section' => 'Narra'
        ]);

        // Grade 7 - Lawaan Section
        Student::create([
            'student_number' => 'STD-' . Str::random(8),
            'first_name' => 'Sofia',
            'last_name' => 'Cruz',
            'middle_name' => 'M.',
            'gender' => 'Female',
            'grade_level' => 7,
            'section' => 'Lawaan'
        ]);

        Student::create([
            'student_number' => 'STD-' . Str::random(8),
            'first_name' => 'Miguel',
            'last_name' => 'Rodriguez',
            'middle_name' => 'S.',
            'gender' => 'Male',
            'grade_level' => 7,
            'section' => 'Lawaan'
        ]);

        Student::create([
            'student_number' => 'STD-' . Str::random(8),
            'first_name' => 'Ana',
            'last_name' => 'Reyes',
            'middle_name' => 'B.',
            'gender' => 'Female',
            'grade_level' => 7,
            'section' => 'Lawaan'
        ]);

        // Grade 7 - Dao Section
        Student::create([
            'student_number' => 'STD-' . Str::random(8),
            'first_name' => 'Jose',
            'last_name' => 'Garcia',
            'middle_name' => 'T.',
            'gender' => 'Male',
            'grade_level' => 7,
            'section' => 'Dao'
        ]);

        Student::create([
            'student_number' => 'STD-' . Str::random(8),
            'first_name' => 'Isabella',
            'last_name' => 'Fernandez',
            'middle_name' => 'C.',
            'gender' => 'Female',
            'grade_level' => 7,
            'section' => 'Dao'
        ]);

        // Grade 7 - Mahugani Section
        Student::create([
            'student_number' => 'STD-' . Str::random(8),
            'first_name' => 'Luis',
            'last_name' => 'Morales',
            'middle_name' => 'D.',
            'gender' => 'Male',
            'grade_level' => 7,
            'section' => 'Mahugani'
        ]);

        Student::create([
            'student_number' => 'STD-' . Str::random(8),
            'first_name' => 'Carmen',
            'last_name' => 'Villanueva',
            'middle_name' => 'E.',
            'gender' => 'Female',
            'grade_level' => 7,
            'section' => 'Mahugani'
        ]);
    }
}