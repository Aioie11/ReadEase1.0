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
        'reading_material_id',
        'answers',
        'score',
        'total_questions',
        'reading_time',
        'reading_speed'
    ];

    protected $casts = [
        'answers' => 'array',
        'reading_time' => 'integer',
        'reading_speed' => 'integer'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'userId');
    }

    public function readingMaterial()
    {
        return $this->belongsTo(\App\Models\ReadingMaterial::class, 'reading_material_id');
    }
}
