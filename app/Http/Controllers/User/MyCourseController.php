<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\QuestionnaireResult;
use App\Models\UserCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class MyCourseController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // get questionner result if exists
        $questionnaireResult = QuestionnaireResult::where('user_id', $user->id)
            ->with([
                'category',
                'firstCategory',
                'secondCategory',
            ])
            ->orderBy('created_at', 'desc')
            ->first();

        $userCourses = UserCourse::where('user_id', $user->id)->get();

        $courses = Course::with([
            'mentor' => function ($query) {
                $query->select('id', 'fullname', 'username', 'profile_picture');
                $query->with('mentorDetail');
            },
            'categories' => function ($query) {
                $query->whereNull('parent_id');
            },
            'joined',
        ])
            ->whereIn('id', $userCourses->pluck('course_id'))
            ->get();

        // get related courses based on the questionnaire result and user courses
        // sometimes the second category is null
        // get the categories first
        $categories = [
            $questionnaireResult->firstCategory->id,
        ];

        if ($questionnaireResult->secondCategory) {
            $categories[] = $questionnaireResult->secondCategory->id;
        }

        // append the user courses (if not exists)
        $coursesCategories = $courses->map(function ($course) {
            return $course->categories->pluck('id');
        })->flatten()->unique();

        $categories = array_merge($categories, $coursesCategories->toArray());

        $relatedCourses = Course::whereExists(function ($query) use ($categories) {
            $query->select(DB::raw(1))
                ->from('categories')
                ->join('course_categories', 'categories.id', '=', 'course_categories.category_id')
                ->whereColumn('courses.id', 'course_categories.course_id')
                ->whereIn('categories.id', $categories);
        })
            ->whereNotIn('courses.id', $userCourses->pluck('course_id'))
            ->inRandomOrder()
            ->with([
                'mentor' => function ($query) {
                    $query->select('id', 'profile_picture', 'fullname', 'username');
                    $query->with('mentorDetail');
                },
                'categories' => function ($query) {
                    $query->whereNull('parent_id');
                },
            ])
            ->limit(6)
            ->get();

        // return response()->json(compact('courses'));
        // return response()->json([
        //     'courses' => $courses,
        //     'questionnaire_result' => $questionnaireResult,
        //     'related_courses' => $relatedCourses,
        // ]);
        return Inertia::render('Course/MyCourse', compact('courses', 'questionnaireResult', 'relatedCourses'));
    }
}