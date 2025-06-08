<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherFeedback extends Model
{
    use HasFactory;

    protected $table = 'teacher_feedback';

    protected $fillable = [
        'student_id',
        'teacher_id',
        'teacher_name',
        'language',
        'grade_level',
        'section',
        'strengths',
        'areas_for_improvement',
        'recommendations',
        'is_sent',
        'sent_at',
        'is_read',
        'read_at'
    ];

    protected $casts = [
        'is_sent' => 'boolean',
        'is_read' => 'boolean',
        'sent_at' => 'datetime',
        'read_at' => 'datetime',
        'grade_level' => 'integer'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_number');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // Scope for getting feedback by language
    public function scopeByLanguage($query, $language)
    {
        return $query->where('language', $language);
    }

    // Scope for getting sent feedback
    public function scopeSent($query)
    {
        return $query->where('is_sent', true);
    }

    // Scope for getting unread feedback
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }
}
