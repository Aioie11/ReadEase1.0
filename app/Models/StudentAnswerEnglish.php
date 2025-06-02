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
        'answers',
        'score',
        'reading_time',
        'start_time',
        'end_time'
    ];

    protected $casts = [
        'answers' => 'array',
        'reading_time' => 'integer',
        'reading_speed' => 'integer',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'userId');
    }
}
