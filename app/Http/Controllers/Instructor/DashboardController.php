<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $courses = auth()->user()->courses()
            ->withCount('enrollments')
            ->latest()
            ->get();
            
        $totalStudents = $courses->sum('enrollments_count');
        $publishedCount = $courses->where('status', 'published')->count();
        
        return view('instructor.dashboard', compact('courses', 'totalStudents', 'publishedCount'));
    }
}
