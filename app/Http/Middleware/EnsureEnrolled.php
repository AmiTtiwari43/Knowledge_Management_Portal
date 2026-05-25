<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEnrolled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $course = $request->route('course');
        
        // Handle if $course is just a slug (string) instead of a Model
        if (is_string($course)) {
            $course = \App\Models\Course::where('slug', $course)->first();
        }
        
        if ($course) {
            $user = auth()->user();
            $isInstructor = ($user->role === 'instructor' && $user->id === $course->instructor_id);
            $isAdmin = ($user->role === 'admin');
            $isEnrolled = $user->enrollments()->where('course_id', $course->id)->exists();

            if (!$isEnrolled && !$isInstructor && !$isAdmin) {
                return redirect()->route('courses.show', $course->slug)->with('error', 'You must be enrolled to access this content.');
            }
        }

        return $next($request);
    }
}
