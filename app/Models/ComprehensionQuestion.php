<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComprehensionQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'reading_material_id',
        'question',
        'type',
        'options',
        'correct_answer',
        'explanation',
        'order'
    ];

    protected $casts = [
        'options' => 'array'
    ];

    public function readingMaterial()
    {
        return $this->belongsTo(ReadingMaterial::class);
    }
}
