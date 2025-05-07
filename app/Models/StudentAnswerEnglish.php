<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAnswerEnglish extends Model
{
    use HasFactory;

    protected $table = 'student_answer_english';
    protected $fillable = [
        'student_id',
        'c1',
        'c2',
        'c3',
        'c4',
        'c5',
        'c6',
        'c7',
        'score',
    ];
}
