<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LectureProgress extends Model
{
    /** @use HasFactory<\Database\Factories\LectureProgressFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'lecture_id', 'completed', 'watched_seconds'];

    protected function casts(): array
    {
        return ['completed' => 'boolean'];
    }

}
