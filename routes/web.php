<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\CourseController;
use App\Http\Controllers\User\AboutController;
use App\Http\Controllers\User\CourseWatchController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::as('courses.')->prefix('courses')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::get('/search', [CourseController::class, 'search'])->name('search');

        Route::as('show.')->prefix('/{course:slug}')->group(function () {
            Route::get('/', [CourseWatchController::class, 'show'])->name('show');
            Route::get('/watch/{order}', [CourseWatchController::class, 'watch'])->name('watch');
        });
        // Route::get('/{course:slug}', [CourseWatchController::class, 'show'])->name('show');
    });
});

// Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
// Route::get('/courses/search', [CourseController::class, 'search'])->name('courses.search');
// Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');


require __DIR__ . '/auth.php';
