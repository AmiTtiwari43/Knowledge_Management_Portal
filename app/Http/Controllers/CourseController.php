<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function home()
    {
        $featuredCourses = Course::where('status', 'published')
            ->with(['instructor', 'category'])
            ->latest()
            ->take(6)
            ->get();
            
        $categories = Category::withCount('courses')->get();

        $heroTitle = \App\Models\Setting::get('hero_title', 'Master Your Skills with Expert Courses');
        $heroSubtitle = \App\Models\Setting::get('hero_subtitle', 'Join thousands of students learning today from industry leaders.');
        
        return view('pages.home', compact('featuredCourses', 'categories', 'heroTitle', 'heroSubtitle'));
    }

    public function index(Request $request)
    {
        return view('pages.catalog');
    }

    public function show(Course $course)
    {
        if ($course->status !== 'published' && (!auth()->check() || auth()->id() !== $course->instructor_id)) {
            abort(404);
        }
        
        $course->load(['instructor', 'category', 'sections.lectures', 'reviews.user']);
        
        return view('pages.course-detail', compact('course'));
    }
}
