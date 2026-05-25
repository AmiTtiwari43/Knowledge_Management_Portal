<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory, HasSlug, InteractsWithMedia;

    protected $fillable = ['instructor_id', 'category_id', 'title', 'slug', 'description', 'thumbnail', 'preview_video_url', 'price', 'level', 'language', 'status', 'rating_avg', 'students_count'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class)->orderBy('position');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function quiz()
    {
        return $this->hasOne(Quiz::class);
    }

    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            if (str_starts_with($this->thumbnail, 'http')) {
                return $this->thumbnail;
            }
            return asset('storage/' . $this->thumbnail);
        }

        // Try to get from preview video
        $videoId = $this->extractYoutubeId($this->preview_video_url);
        
        // If no preview video, try first lecture
        if (!$videoId) {
            $firstLecture = $this->sections()->first()?->lectures()->where('type', 'video')->first();
            if ($firstLecture) {
                $videoId = $this->extractYoutubeId($firstLecture->video_url);
            }
        }

        if ($videoId) {
            return "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";
        }

        return 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80';
    }

    private function extractYoutubeId($url)
    {
        if (!$url) return null;
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $url, $match)) {
            return $match[1];
        }
        return null;
    }
}
