<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Services\CertificateService;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function download(Course $course, CertificateService $service)
    {
        $enrollment = auth()->user()->enrollments()->where('course_id', $course->id)->first();
        
        if (!$enrollment || $enrollment->progress_percent < 100) {
            return back()->with('error', 'You must complete the course to download the certificate.');
        }

        $lastAttempt = auth()->user()->quizAttempts()
            ->where('quiz_id', $course->quiz->id)
            ->where('passed', true)
            ->first();
        
        if (!$lastAttempt) {
            return back()->with('error', 'You must pass the final quiz to download the certificate.');
        }

        $pdf = $service->generate(auth()->user(), $course);
        
        return $pdf->download("Certificate-{$course->slug}.pdf");
    }

    public function view(Course $course, CertificateService $service)
    {
        $enrollment = auth()->user()->enrollments()->where('course_id', $course->id)->first();
        
        if (!$enrollment || $enrollment->progress_percent < 100) {
            return back()->with('error', 'You must complete the course to view the certificate.');
        }

        $lastAttempt = auth()->user()->quizAttempts()
            ->where('quiz_id', $course->quiz->id)
            ->where('passed', true)
            ->first();
        
        if (!$lastAttempt) {
            return back()->with('error', 'You must pass the final quiz to view the certificate.');
        }

        $pdf = $service->generate(auth()->user(), $course);
        
        return $pdf->stream("Certificate-{$course->slug}.pdf");
    }
}
