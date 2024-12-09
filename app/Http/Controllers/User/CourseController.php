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
            'categories' => function ($query) {
                $query->whereNull('parent_id');
            },
            'joined'
        ])
            ->published()
            ->latest()->limit(6)->get();

        $years = [now()->year, now()->subYears(2)->year, null];
        $popularCourses = collect();

        foreach ($years as $year) {
            $query = Course::with([
                'mentor' => function ($query) {
                    $query->select('id', 'profile_picture', 'fullname', 'username');
                    $query->with('mentorDetail');
                },
                'categories' => function ($query) {
                    $query->whereNull('parent_id');
                },
                'joined'
            ])
                ->published()
                ->withCount('users')
                ->orderBy('users_count', 'desc')
                ->limit(6);

            if ($year) {
                $query->whereYear('created_at', '>=', $year);
            }

            $popularCourses = $query->get();

            if ($popularCourses->count() >= 6 || $year === null) {
                break;
            }
        }

        // return response()->json(compact('latestCourses', 'popularCourses', 'categories'));

        return Inertia::render('Course/ListCourse', compact('latestCourses', 'popularCourses', 'categories'));
    }

    public function search(Request $request)
    {
        $categories = Category::parentOnly()->get();
        $categoryQuery = explode(',', $request->get('categories', ''));
        $query = $request->get('query', '');


        $courses = Course::with([
            'mentor' => function ($query) {
                $query->select('id', 'profile_picture', 'fullname', 'username');
                $query->with('mentorDetail');
            },
            'categories' => function ($query) {
                $query->whereNull('parent_id');
            },
            'joined'
        ])
            ->when($query, function ($q, $query) {
                return $q->where('name', 'like', '%' . $query . '%');
            })
            ->when($categoryQuery, function ($q, $categoryQuery) {
                return $q->whereHas('categories', function ($q) use ($categoryQuery) {
                    $q->whereIn('slug', $categoryQuery);
                });
            })
            ->latest()
            ->published()
            ->paginate(10);

        return response()->json(compact('courses', 'categories', 'query', 'categoryQuery'));
        return Inertia::render('Course/SearchCourse', compact('courses', 'categories', 'query', 'categoryQuery'));
    }
}
