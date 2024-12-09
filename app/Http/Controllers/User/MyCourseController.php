<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\QuestionnaireResult;
use App\Models\UserCourse;
use Illuminate\Http\Request;

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
            'categories',
            'joined'
        ])
            ->whereIn('id', $userCourses->pluck('course_id'))
            ->get();

        // return response()->json(compact('courses'));
        return response()->json([
            'courses' => $courses,
            'questionnaire_result' => $questionnaireResult,
        ]);
    }
}
