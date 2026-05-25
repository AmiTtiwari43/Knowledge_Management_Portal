<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $enrollments = auth()->user()->enrollments()
            ->with(['course.instructor', 'course.category'])
            ->latest()
            ->get();
            
        return view('student.dashboard', compact('enrollments'));
    }

    public function achievements()
    {
        $enrollments = auth()->user()->enrollments()
            ->with(['course.instructor', 'course.category'])
            ->latest()
            ->get();
            
        return view('student.achievements', compact('enrollments'));
    }
}
