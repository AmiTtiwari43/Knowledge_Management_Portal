<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CoursePolicy
{
    public function view(User $user, Course $course): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role === 'instructor' || $user->role === 'admin';
    }

    public function update(User $user, Course $course): bool
    {
        return $user->id === $course->instructor_id || $user->role === 'admin';
    }

    public function delete(User $user, Course $course): bool
    {
        return $user->id === $course->instructor_id || $user->role === 'admin';
    }
}
