<?php

namespace App\Http\Controllers\User;

use App\Enums\CourseStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseController extends Controller
{
    public function index()
    {
        $categories = Category::parentOnly()->get();

        $latestCourses = Course::with([
            'mentor' => function ($query) {
                $query->select('id', 'profile_picture', 'fullname', 'username');
                $query->with('mentorDetail');
            },
            'categories',
            'joined'
        ])
            ->published()
            ->latest()->limit(6)->get();

        $popularCourses = Course::with([
            'mentor' => function ($query) {
                $query->select('id', 'profile_picture', 'fullname', 'username');
                $query->with('mentorDetail');
            },
            'categories',
            'joined'
        ])
            ->published()
            ->withCount('users')
            ->orderBy('users_count', 'desc')
            ->limit(6)->get();

        // return response()->json(compact('latestCourses', 'popularCourses', 'categories'));

        return Inertia::render('Course/ListCourse', compact('latestCourses', 'popularCourses', 'categories'));
    }

    public function search(Request $request)
    {
        $categories = Category::parentOnly()->get();
        $categoryQuery = explode(',', $request->get('category', ''));
        $query = $request->get('query', '');


        $courses = Course::with([
            'mentor' => function ($query) {
                $query->select('id', 'profile_picture', 'fullname', 'username');
                $query->with('mentorDetail');
            },
            'categories',
            'joined'
        ])
            ->where('name', 'like', '%' . $query . '%')
            ->orWhereHas('categories', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->when($categoryQuery, function ($q, $categoryQuery) {
                return $q->whereHas('categories', function ($q) use ($categoryQuery) {
                    $q->whereIn('slug', $categoryQuery);
                });
            })
            ->published()
            ->paginate(10);

        return response()->json(compact('courses', 'categories', 'query', 'categoryQuery'));
        return Inertia::render('Course/SearchCourse', compact('courses', 'categories', 'query', 'categoryQuery'));
    }
}
