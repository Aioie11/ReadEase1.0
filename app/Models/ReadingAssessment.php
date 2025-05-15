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
        'reading_speed',
        'section',
        'language',
        'assessment_date'
    ];

    protected $casts = [
        'reading_time' => 'float',
        'miscues' => 'integer',
        'total_words' => 'integer',
        'reading_speed' => 'integer',
        'assessment_date' => 'datetime'
    ];
} 