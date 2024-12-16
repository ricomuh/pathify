<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CourseComment;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            // 'reportable_id' => 'required|exists:course_comments,id',
            'reportable_type' => 'required|string|in:course_comments',
            'reason' => 'required|string',
            'description' => 'nullable|string',
        ]);

        switch ($request->reportable_type) {
            case 'course_comments':
                return $this->reportCourseComment($request);
                break;
            default:
                abort(404);
        }

        // $comment = CourseComment::findOrFail($request->reportable_id);

        // Report::create([
        //     'user_id' => auth()->id(),
        //     'reportable_id' => $comment->id,
        //     'reportable_type' => CourseComment::class,
        //     'reason' => $request->reason,
        //     'description' => $request->description,
        // ]);

        // return redirect()->back()->with('success', 'Comment has been reported.');
    }

    protected function reportCourseComment(Request $request)
    {
        $request->validate([
            'reportable_id' => 'required|exists:course_comments,id',
        ]);

        $comment = CourseComment::findOrFail($request->reportable_id);

        Report::create([
            'user_id' => auth()->id(),
            'reportable_id' => $comment->id,
            'reportable_type' => CourseComment::class,
            'reason' => $request->reason,
            'description' => $request->description ?? null,
        ]);

        return redirect()->back()->with('success', 'Comment has been reported.');
    }
}
