<?php

namespace App\Services;

use App\Models\Course;
use App\Models\User;
use App\Models\Certificate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class CertificateService
{
    public function generate(User $user, Course $course)
    {
        $certificate = Certificate::firstOrCreate([
            'user_id' => $user->id,
            'course_id' => $course->id,
        ], [
            'uuid' => (string) Str::uuid(),
            'issued_at' => now(),
        ]);

        $lastAttempt = $user->quizAttempts()
            ->where('quiz_id', $course->quiz->id)
            ->where('passed', true)
            ->orderByDesc('score')
            ->first();

        $pdf = Pdf::loadView('certificates.template', [
            'user' => $user,
            'course' => $course,
            'certificate' => $certificate,
            'score' => $lastAttempt->score ?? 0,
        ]);

        return $pdf;
    }
}
