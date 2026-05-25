<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\EnrollmentController;
use App\Http\Controllers\Student\LectureController;
use App\Http\Controllers\Student\NoteController;
use App\Http\Controllers\Student\CertificateController;
use App\Http\Controllers\Student\ReviewController;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/achievements', [DashboardController::class, 'achievements'])->name('achievements');

    // Course Player (Enrolled users only)
    Route::middleware(['enrolled'])->group(function () {
        Route::get('/courses/{course:slug}/learn', \App\Livewire\CoursePlayer::class)->name('course.learn');
        Route::get('/courses/{course:slug}/quiz', \App\Livewire\QuizPlayer::class)->name('course.quiz');
        Route::post('/courses/{course}/progress', [LectureController::class, 'markProgress'])->name('course.progress');
        Route::post('/lectures/{lecture}/notes', [NoteController::class, 'store'])->name('notes.store');
        Route::post('/courses/{course}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
        Route::get('/courses/{course:slug}/certificate', [CertificateController::class, 'download'])->name('certificate.download');
        Route::get('/courses/{course:slug}/certificate/view', [CertificateController::class, 'view'])->name('certificate.view');
    });
});
