<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => view('home'))->name('home');

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    // Auth pages
    Route::view('/login', 'auth.login')->name('login');
    Route::view('/register', 'auth.register')->name('register');

    // Auth actions
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Statistics
    Route::view('/statistics', 'admin.statistics')->name('statistics');

    // Student
    Route::resource('courses', CourseController::class);
    Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
    Route::view('/assignments', 'student.assignments')->name('student.assignments');

    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {

        Route::get('/settings', [ProfileController::class, 'settings'])->name('settings');
        Route::put('/update', [ProfileController::class, 'updateProfile'])->name('update');

        Route::get('/security', [ProfileController::class, 'security'])->name('security');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');

        Route::get('/sessions', [ProfileController::class, 'sessions'])->name('sessions');
        Route::delete('/sessions/{session}', [ProfileController::class, 'destroySession'])->name('sessions.destroy');
        Route::post('/sessions/logout-others', [ProfileController::class, 'logoutOtherDevices'])->name('sessions.logout-others');
    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin
    Route::prefix('admin')->name('admin.')->group(function () {

        Route::resource('users', UserController::class)
            ->middleware('permission:users.view');

        Route::resource('roles', RoleController::class)
            ->middleware('permission:roles.view');
    });
});
