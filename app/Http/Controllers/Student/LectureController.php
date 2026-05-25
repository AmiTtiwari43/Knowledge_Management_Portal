<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    public function show(Course $course)
    {
        // Check if user is enrolled
        if (!auth()->user()->enrollments()->where('course_id', $course->id)->exists()) {
            return redirect()->route('courses.show', $course->slug)->with('error', 'You must be enrolled to watch this course.');
        }

        return view('student.player', compact('course'));
    }
}
