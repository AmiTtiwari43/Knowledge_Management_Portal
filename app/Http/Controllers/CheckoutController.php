<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function process(Course $course)
    {
        if (auth()->user()->role !== 'student') {
            return back()->with('error', 'Only students can enroll in courses.');
        }

        // For free courses, enroll immediately
        if ($course->price <= 0) {
            auth()->user()->enrollments()->firstOrCreate([
                'course_id' => $course->id
            ], [
                'progress_percent' => 0
            ]);

            $course->increment('students_count');

            return redirect()->route('student.course.learn', $course->slug)
                ->with('success', 'Enrolled successfully!');
        }

        // For paid courses, redirect to a mock checkout or just enroll for now (simulating payment)
        // In a real app, you would integrate Stripe here.
        auth()->user()->enrollments()->firstOrCreate([
            'course_id' => $course->id
        ], [
            'progress_percent' => 0,
            'payment_id' => 'MOCK_STRIPE_' . uniqid()
        ]);

        $course->increment('students_count');

        return redirect()->route('student.course.learn', $course->slug)
            ->with('success', 'Payment successful and enrolled!');
    }

    public function success()
    {
        return view('pages.checkout-success');
    }
}
