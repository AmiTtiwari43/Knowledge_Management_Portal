<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\Section;
use App\Models\User;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $instructor = User::where('role', 'instructor')->first();
        $categories = Category::all();

        if (!$instructor || $categories->isEmpty()) {
            return;
        }

        $courses = [
            [
                'title' => 'Laravel 11 for Beginners',
                'category_id' => $categories->where('name', 'Web Development')->first()->id,
                'description' => 'Learn the fundamentals of Laravel 11 from scratch. We will build a complete application step by step.',
                'price' => 49.99,
                'level' => 'beginner',
                'thumbnail' => 'https://images.unsplash.com/photo-1537432376769-00f5c2f4c8d2?auto=format&fit=crop&w=800&q=80',
                'preview_video_url' => 'https://www.youtube.com/watch?v=MYyJ4PuL4pY',
                'sections' => [['title' => 'Basics', 'lectures' => [['title' => 'Intro', 'video_url' => 'https://www.youtube.com/watch?v=MYyJ4PuL4pY', 'duration_seconds' => 300]]]]
            ],
            [
                'title' => 'Tailwind CSS Mastery',
                'category_id' => $categories->where('name', 'Web Development')->first()->id,
                'description' => 'Master the utility-first CSS framework.',
                'price' => 29.99,
                'level' => 'intermediate',
                'thumbnail' => 'https://images.unsplash.com/photo-1587620962725-abab7fe55159?auto=format&fit=crop&w=800&q=80',
                'preview_video_url' => 'https://www.youtube.com/watch?v=lCxcTsOHrjo',
                'sections' => [['title' => 'Basics', 'lectures' => [['title' => 'Intro', 'video_url' => 'https://www.youtube.com/watch?v=lCxcTsOHrjo', 'duration_seconds' => 300]]]]
            ],
            [
                'title' => 'Modern Web Design',
                'category_id' => $categories->where('name', 'Design')->first()->id,
                'description' => 'Learn principles of modern design.',
                'price' => 39.99,
                'level' => 'beginner',
                'thumbnail' => 'https://images.unsplash.com/photo-1558655146-d09347e92766?auto=format&fit=crop&w=800&q=80',
                'preview_video_url' => 'https://www.youtube.com/watch?v=c9Wg6ndoxag',
                'sections' => [['title' => 'Basics', 'lectures' => [['title' => 'Intro', 'video_url' => 'https://www.youtube.com/watch?v=c9Wg6ndoxag', 'duration_seconds' => 300]]]]
            ],
            [
                'title' => 'Next.js 14 Deep Dive',
                'category_id' => $categories->where('name', 'Web Development')->first()->id,
                'description' => 'Build high-performance web apps with Next.js.',
                'price' => 59.99,
                'level' => 'advanced',
                'thumbnail' => 'https://images.unsplash.com/photo-1618477388954-7852f32655ec?auto=format&fit=crop&w=800&q=80',
                'preview_video_url' => 'https://www.youtube.com/watch?v=9He4UBLp820',
                'sections' => [['title' => 'Basics', 'lectures' => [['title' => 'Intro', 'video_url' => 'https://www.youtube.com/watch?v=9He4UBLp820', 'duration_seconds' => 300]]]]
            ],
            [
                'title' => 'React for Beginners',
                'category_id' => $categories->where('name', 'Web Development')->first()->id,
                'description' => 'The complete guide to React.',
                'price' => 44.99,
                'level' => 'beginner',
                'thumbnail' => 'https://images.unsplash.com/photo-1633356122544-f134324a6cee?auto=format&fit=crop&w=800&q=80',
                'preview_video_url' => 'https://www.youtube.com/watch?v=hQAHSlTtcmY',
                'sections' => [['title' => 'Basics', 'lectures' => [['title' => 'Intro', 'video_url' => 'https://www.youtube.com/watch?v=hQAHSlTtcmY', 'duration_seconds' => 300]]]]
            ],
            [
                'title' => 'Python Data Science',
                'category_id' => $categories->where('name', 'Data Science')->first()->id,
                'description' => 'Master Python for Data Science.',
                'price' => 69.99,
                'level' => 'intermediate',
                'thumbnail' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&w=800&q=80',
                'preview_video_url' => 'https://www.youtube.com/watch?v=u4ovE8aTvnM',
                'sections' => [['title' => 'Basics', 'lectures' => [['title' => 'Intro', 'video_url' => 'https://www.youtube.com/watch?v=u4ovE8aTvnM', 'duration_seconds' => 300]]]]
            ],
            [
                'title' => 'Node.js Architecture',
                'category_id' => $categories->where('name', 'Web Development')->first()->id,
                'description' => 'Advanced Node.js concepts.',
                'price' => 54.99,
                'level' => 'advanced',
                'thumbnail' => 'https://images.unsplash.com/photo-1504639725590-34d0984388bd?auto=format&fit=crop&w=800&q=80',
                'preview_video_url' => 'https://www.youtube.com/watch?v=F3zw1Gvn4Mk',
                'sections' => [['title' => 'Basics', 'lectures' => [['title' => 'Intro', 'video_url' => 'https://www.youtube.com/watch?v=F3zw1Gvn4Mk', 'duration_seconds' => 300]]]]
            ],
            [
                'title' => 'Figma for Devs',
                'category_id' => $categories->where('name', 'Design')->first()->id,
                'description' => 'Design tools for developers.',
                'price' => 24.99,
                'level' => 'beginner',
                'thumbnail' => 'https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?auto=format&fit=crop&w=800&q=80',
                'preview_video_url' => 'https://www.youtube.com/watch?v=Gu6z6kIukgg',
                'sections' => [['title' => 'Basics', 'lectures' => [['title' => 'Intro', 'video_url' => 'https://www.youtube.com/watch?v=Gu6z6kIukgg', 'duration_seconds' => 300]]]]
            ],
            [
                'title' => 'SQL Mastery',
                'category_id' => $categories->where('name', 'Data Science')->first()->id,
                'description' => 'Database design and SQL.',
                'price' => 34.99,
                'level' => 'intermediate',
                'thumbnail' => 'https://images.unsplash.com/photo-1544383835-bda2bc66a55d?auto=format&fit=crop&w=800&q=80',
                'preview_video_url' => 'https://www.youtube.com/watch?v=7S_tz1z_5bA',
                'sections' => [['title' => 'Basics', 'lectures' => [['title' => 'Intro', 'video_url' => 'https://www.youtube.com/watch?v=7S_tz1z_5bA', 'duration_seconds' => 300]]]]
            ],
            [
                'title' => 'Full-Stack JavaScript',
                'category_id' => $categories->where('name', 'Web Development')->first()->id,
                'description' => 'MERN Stack from scratch.',
                'price' => 79.99,
                'level' => 'advanced',
                'thumbnail' => 'https://images.unsplash.com/photo-1542831371-29b0f74f9713?auto=format&fit=crop&w=800&q=80',
                'preview_video_url' => 'https://www.youtube.com/watch?v=kYI9UqWv9Sg',
                'sections' => [['title' => 'Basics', 'lectures' => [['title' => 'Intro', 'video_url' => 'https://www.youtube.com/watch?v=kYI9UqWv9Sg', 'duration_seconds' => 300]]]]
            ],
        ];

        foreach ($courses as $cData) {
            $course = Course::create([
                'instructor_id' => $instructor->id,
                'category_id' => $cData['category_id'],
                'title' => $cData['title'],
                'slug' => \Illuminate\Support\Str::slug($cData['title']),
                'description' => $cData['description'],
                'price' => $cData['price'],
                'level' => $cData['level'],
                'thumbnail' => $cData['thumbnail'],
                'preview_video_url' => $cData['preview_video_url'],
                'status' => 'published',
            ]);

            foreach ($cData['sections'] as $sIndex => $sData) {
                $section = Section::create([
                    'course_id' => $course->id,
                    'title' => $sData['title'],
                    'position' => $sIndex + 1,
                ]);

                foreach ($sData['lectures'] as $lIndex => $lData) {
                    Lecture::create([
                        'section_id' => $section->id,
                        'title' => $lData['title'],
                        'type' => 'video',
                        'video_url' => $lData['video_url'],
                        'duration_seconds' => $lData['duration_seconds'],
                        'position' => $lIndex + 1,
                    ]);
                }
            }
        }
    }
}
