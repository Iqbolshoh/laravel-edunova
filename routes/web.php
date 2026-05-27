<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
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
    // Auth Views
    Route::view('/login', 'auth.login')->name('login');
    Route::view('/register', 'auth.register')->name('register');

    // Auth Actions
    Route::controller(AuthController::class)->group(function () {
        Route::post('/login', 'login')->name('login.post');
        Route::post('/register', 'register')->name('register.post');
    });
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // General Dashboard & Statistics
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/statistics', 'admin.statistics')->name('statistics');

    // --------------------------------------------------------
    // Courses & Lessons
    // --------------------------------------------------------
    Route::resource('courses', CourseController::class);
    Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');

    Route::resource('courses.lessons', LessonController::class);

    // --------------------------------------------------------
    // Assignments & Submissions
    // --------------------------------------------------------
    Route::resource('assignments', AssignmentController::class);

    Route::controller(AssignmentController::class)->group(function () {
        // Assignment Actions
        Route::get('/assignments/{assignment}/submit', 'submit')->name('assignments.submit');
        Route::post('/assignments/{assignment}/submit', 'submit')->name('assignments.submit');

        // Submission Actions
        Route::get('/submissions/{submission}/download', 'download')->name('submissions.download');
        Route::post('/submissions/{submission}/grade', 'grade')->name('submissions.grade');
    });

    // --------------------------------------------------------
    // User Profile
    // --------------------------------------------------------
    Route::prefix('profile')->name('profile.')->controller(ProfileController::class)->group(function () {
        // Settings
        Route::get('/settings', 'settings')->name('settings');
        Route::put('/update', 'updateProfile')->name('update');

        // Security
        Route::get('/security', 'security')->name('security');
        Route::put('/password', 'updatePassword')->name('password.update');

        // Sessions
        Route::get('/sessions', 'sessions')->name('sessions');
        Route::delete('/sessions/{session}', 'destroySession')->name('sessions.destroy');
        Route::post('/sessions/logout-others', 'logoutOtherDevices')->name('sessions.logout-others');
    });

    // --------------------------------------------------------
    // Administration
    // --------------------------------------------------------
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class)->middleware('permission:users.view');
        Route::resource('roles', RoleController::class)->middleware('permission:roles.view');
    });

    // Logout Action
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
