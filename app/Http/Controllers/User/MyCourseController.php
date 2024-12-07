<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\UserCourse;
use Illuminate\Http\Request;

class MyCourseController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $userCourses = UserCourse::where('user_id', $user->id)->get();

        $courses = Course::with([
            'mentor' => function ($query) {
                $query->select('id', 'fullname', 'username', 'profile_picture');
                $query->with('mentorDetail');
            },
            'categories',
            'joined'
        ])
            ->whereIn('id', $userCourses->pluck('course_id'))
            ->get();

        return response()->json(compact('courses'));
    }
}
