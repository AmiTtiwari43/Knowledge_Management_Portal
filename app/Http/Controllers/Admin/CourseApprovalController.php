<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseApprovalController extends Controller
{
    public function index()
    {
        $courses = Course::where('status', 'pending')
            ->with('instructor')
            ->latest()
            ->get();
            
        return view('admin.courses.queue', compact('courses'));
    }

    public function approve(Course $course)
    {
        $course->update(['status' => 'published']);
        return back()->with('success', 'Course approved and published successfully!');
    }

    public function reject(Course $course)
    {
        $course->update(['status' => 'draft']);
        return back()->with('success', 'Course rejected and moved back to draft.');
    }
}
