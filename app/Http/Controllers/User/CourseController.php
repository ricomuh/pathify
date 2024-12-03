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
        $courses = Course::with([
            'mentor',
            'categories'
        ])
            ->where('status_id', CourseStatusEnum::Published)
            ->latest()->get();

        // dd($courses);

        return Inertia::render('Course/ListCourse', [
            'courses' => $courses
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');

        $courses = Course::with([
            'mentor',
            'categories',
        ])
            ->where('name', 'like', '%' . $query . '%')
            ->orWhereHas('categories', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->where('status_id', CourseStatusEnum::Published)
            ->get();

        return Inertia::render('Course/SearchCourse', [
            'query' => $query,
            'courses' => $courses,
        ]);
    }

    public function show(Course $course)
    {
        $course->load([
            'mentor',
            'status',
            'categories',
            'contents' => function ($query) {
                $query->orderBy('order', 'asc');
                $query->select('id', 'course_id', 'title', 'description');
            }
        ])->loadCount('users');

        // check if user has access to this course
        $hasAccess = auth()->user()->hasAccess($course);
        dd(compact('course', 'hasAccess'));

        return Inertia::render('Course/DetailCourse', compact('course', 'hasAccess'));
    }
}
