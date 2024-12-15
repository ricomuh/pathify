<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\QuestionnaireResult;
use App\Models\UserCourse;
use App\Models\UserEvent;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $questionnaireResult = QuestionnaireResult::where('user_id', auth()->id())
            ->with(
                'user',
                'category',
                'firstCategory',
                'secondCategory',
            )
            ->latest()
            ->first();

        $coursesCount = UserCourse::where('user_id', auth()->id())->count();
        $eventsCount = UserEvent::where('user_id', auth()->id())->count();
        $certificateCount = 0;

        return Inertia::render('Dashboard', compact('questionnaireResult', 'coursesCount', 'eventsCount', 'certificateCount'));
    }
}
