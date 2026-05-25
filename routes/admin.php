<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CourseApprovalController;
use App\Http\Controllers\Admin\CategoryController;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class)->only(['index', 'destroy']);
    
    Route::get('/courses/queue', [CourseApprovalController::class, 'index'])->name('courses.queue');
    Route::post('/courses/{course}/approve', [CourseApprovalController::class, 'approve'])->name('courses.approve');
    Route::post('/courses/{course}/reject', [CourseApprovalController::class, 'reject'])->name('courses.reject');

    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::patch('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});
