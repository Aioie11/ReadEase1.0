<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentReadingLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'grade_level',
        'reading_level',
        'subject',
        'assessment_date'
    ];

    protected $casts = [
        'grade_level' => 'integer',
        'assessment_date' => 'datetime'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_number');
    }
} 