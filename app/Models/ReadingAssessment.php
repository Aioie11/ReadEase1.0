<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadingAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_name',
        'reading_time',
        'miscues',
        'total_words',
        'correct_answers',
        'total_questions',
        'comprehension',
        'correct_reading',
        'reading_speed',
        'section',
        'language',
        'grade',
        'assessment_date'
    ];

    protected $casts = [
        'reading_time' => 'float',
        'miscues' => 'integer',
        'total_words' => 'integer',
        'correct_answers' => 'integer',
        'total_questions' => 'integer',
        'comprehension' => 'integer',
        'correct_reading' => 'integer',
        'reading_speed' => 'integer',
        'assessment_date' => 'datetime'
    ];
}