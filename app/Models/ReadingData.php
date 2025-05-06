<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadingData extends Model
{
    protected $fillable = [
        'student_name',
        'reading_time',
        'total_words',
        'reading_speed',
        'correct_answers',
        'total_questions',
        'comprehension',
        'word_recognition',
        'word_label',
        'miscues',
        'section',
        'language'
    ];
} 