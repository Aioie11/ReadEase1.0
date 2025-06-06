<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadingAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
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
        'assessment_date',
        'overall_reading_level'
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

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_number');
    }

    /**
     * Calculate and return the overall reading level based on word reading and comprehension scores
     */
    public function calculateOverallReadingLevel()
    {
        $wordReading = $this->correct_reading;
        $comprehension = $this->comprehension;

        // Apply the established reading level criteria
        if ($wordReading >= 97 && $comprehension >= 80) {
            return 'Independent';
        } elseif ($wordReading >= 90 && $wordReading <= 96 && $comprehension >= 59 && $comprehension <= 79) {
            return 'Instructional';
        } else {
            return 'Frustration';
        }
    }

    /**
     * Update the overall reading level and save to database
     */
    public function updateOverallReadingLevel()
    {
        $this->overall_reading_level = $this->calculateOverallReadingLevel();
        $this->save();
        return $this->overall_reading_level;
    }

    /**
     * Get the overall reading level (calculate if not stored)
     */
    public function getOverallReadingLevelAttribute($value)
    {
        // If overall_reading_level is not set, calculate it
        if (is_null($value)) {
            return $this->calculateOverallReadingLevel();
        }
        return $value;
    }
}