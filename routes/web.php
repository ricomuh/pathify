<?php

use App\Http\Controllers\MentorDetailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\CourseController;
use App\Http\Controllers\User\AboutController;
use App\Http\Controllers\User\CourseWatchController;
use App\Http\Controllers\User\EventController;
use App\Http\Controllers\User\MyCourseController;
use App\Http\Controllers\User\MyEventController;
use App\Http\Controllers\User\QuestionnaireController;
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
})->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/my-courses', [MyCourseController::class, 'index'])->name('my-courses.index');
    Route::get('/my-events', [MyEventController::class, 'index'])->name('my-events.index');


    Route::as('questionnaire.')->prefix('questionnaire')->group(function () {
        Route::get('/', [QuestionnaireController::class, 'index'])->name('index');
        Route::post('/', [QuestionnaireController::class, 'store'])->name('store');
    });
});

Route::as('courses.')->prefix('courses')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('index');
    Route::get('/search', [CourseController::class, 'search'])->name('search');

    Route::as('show.')->prefix('/{course:slug}')->group(function () {
        Route::get('/', [CourseWatchController::class, 'show'])->name('show');
        Route::middleware('auth')->group(function () {
            Route::get('/watch/{order}', [CourseWatchController::class, 'watch'])->name('watch');
            Route::get('/submission', [CourseWatchController::class, 'submission'])->name('submission');
        });
    });
    // Route::get('/{course:slug}', [CourseWatchController::class, 'show'])->name('show');
});
// Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
// Route::get('/courses/search', [CourseController::class, 'search'])->name('courses.search');
// Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
// Route::get('/events', [EventController::class, 'index'])->name('events.index');

Route::as('events.')->prefix('events')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('index');
    Route::get('/{event:slug}', [EventController::class, 'show'])->name('show');
});

Route::get('/mentor/{mentor:username}', [MentorDetailController::class, 'show'])->name('mentor.show');


require __DIR__ . '/auth.php';
