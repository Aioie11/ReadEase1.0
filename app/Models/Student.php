<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_number',
        'first_name',
        'last_name',
        'middle_name',
        'gender',
        'grade_level',
        'section'
    ];

    protected $casts = [
        'grade_level' => 'integer'
    ];

    public function englishAnswers()
    {
        return $this->hasMany(StudentAnswerEnglish::class, 'student_id', 'student_number');
    }

    public function tagalogAnswers()
    {
        return $this->hasMany(StudentAnswerTagalog::class, 'student_id', 'student_number');
    }

    public function readingAssessments()
    {
        return $this->hasMany(ReadingAssessment::class, 'student_id', 'student_number');
    }

    public function teacherFeedback()
    {
        return $this->hasMany(TeacherFeedback::class, 'student_id', 'student_number');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'student_number', 'userId');
    }

    public function getUnreadFeedbackCount()
    {
        return $this->teacherFeedback()->where('is_sent', true)->where('is_read', false)->count();
    }
}
