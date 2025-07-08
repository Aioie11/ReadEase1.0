<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAnswerTagalog extends Model
{
    use HasFactory;

    protected $table = 'student_answer_tagalog';
    protected $fillable = [
        'student_id',
        'reading_material_id',
        'answers',
        'score',
        'reading_time',
        'reading_speed',
        'start_time',
        'end_time'
    ];

    protected $casts = [
        'answers' => 'array',
        'reading_time' => 'integer',
        'reading_speed' => 'integer',
        'start_time' => 'datetime',
        'end_time' => 'datetime'
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
