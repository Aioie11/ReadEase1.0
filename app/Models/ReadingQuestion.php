<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadingQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'reading_material_id',
        'question',
        'type',
        'options',
        'correct_answer'
    ];

    protected $casts = [
        'options' => 'array'
    ];

    public function readingMaterial()
    {
        return $this->belongsTo(ReadingMaterial::class);
    }
}
