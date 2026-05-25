<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Instructor\DashboardController;
use App\Http\Controllers\Instructor\CourseController;
use App\Http\Controllers\Instructor\SectionController;
use App\Http\Controllers\Instructor\LectureController;

Route::middleware(['auth'])->group(function () {
    // Only instructors can see the instructor dashboard
    Route::middleware(['role:instructor'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Both instructors and admins can manage courses/curriculum and blogs
    Route::middleware(['role:instructor|admin'])->group(function () {
        Route::resource('courses', CourseController::class);
        Route::resource('sections', SectionController::class)->except(['index', 'show']);
        Route::resource('lectures', LectureController::class)->except(['index', 'show']);
        Route::resource('posts', \App\Http\Controllers\Instructor\PostController::class);
    });
});
