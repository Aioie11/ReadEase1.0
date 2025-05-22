<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadingMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'grade_level',
        'subject',
        'is_published',
        'published_at'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime'
    ];

    public function questions()
    {
        return $this->hasMany(ReadingQuestion::class);
    }
}
