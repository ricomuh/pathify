<?php

namespace App\Http\Controllers\User;

use App\Enums\CourseStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseController extends Controller
{
    public function index()
    {
        // $courses = Course::with([
        //     'mentor',
        //     'categories'
        // ])
        //     ->where('status_id', CourseStatusEnum::Published)
        //     ->latest()->get();

        $latestCourses = Course::with([
            'mentor' => function ($query) {
                $query->select('id', 'profile_picture', 'fullname', 'username');
            },
            'categories',
        ])
            ->published()
            ->latest()->limit(6)->get();

        $popularCourses = Course::with([
            'mentor',
            'categories',
        ])
            ->published()
            ->withCount('users')
            ->orderBy('users_count', 'desc')
            ->limit(6)->get();

        // dd($courses);
        // return response()->json(compact('latestCourses', 'popularCourses'));

        return Inertia::render('Course/ListCourse', compact('latestCourses', 'popularCourses'));
    }


    // public function show(Course $course)
    // {
    //     $course->load([
    //         'mentor',
    //         'status',
    //         'categories',
    //         'contents' => function ($query) {
    //             $query->orderBy('order', 'asc');
    //             $query->select('id', 'course_id', 'title', 'description');
    //         }
    //     ])->loadCount('users');

    //     // check if user has access to this course
    //     $hasAccess = auth()->user()->hasAccess($course);
    //     dd(compact('course', 'hasAccess'));

    //     return Inertia::render('Course/DetailCourse', compact('course', 'hasAccess'));
    // }
}