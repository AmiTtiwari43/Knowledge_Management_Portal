<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    /** @use HasFactory<\Database\Factories\LectureFactory> */
    use HasFactory;

    protected $fillable = ['section_id', 'title', 'type', 'video_url', 'content', 'start_time', 'duration_seconds', 'position', 'is_preview'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
