<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LectureController;

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Laravel UI يوجّه المستخدم إلى /home بعد تسجيل الدخول
    Route::get('/home', function () {
        return redirect()->route('dashboard');
    })->name('home');

    Route::get('/courses', [CourseController::class, 'index'])
        ->name('courses.index');

    Route::get('/lectures', [LectureController::class, 'index'])
        ->name('lectures.index');

    // CRUD المحاضرين للمدير فقط
    Route::middleware('role:admin')->group(function () {
        Route::resource('lecturers', LecturerController::class);
    });
});