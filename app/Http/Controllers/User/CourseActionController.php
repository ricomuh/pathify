<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseComment;
use App\Models\CourseContent;
use App\Models\UserCourse;
use Illuminate\Http\Request;

class CourseActionController extends Controller
{
    public function comment(Course $course, Request $request)
    {
        $request->validate([
            'course_content_id' => 'required|exists:course_contents,id',
            'parent_id' => 'nullable|exists:course_comments,id',
            'body' => 'required|string|max:5000',
        ]);

        // check if user has joined the course
        $courseContent = CourseContent::findOrFail($request->course_content_id);
        // $course = $courseContent->course;
        $userCourse = UserCourse::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->first();

        abort_unless($userCourse, 403, 'You have not joined this course');

        CourseComment::create([
            'course_id' => $course->id,
            'user_id' => auth()->id(),
            'course_content_id' => $courseContent->id,
            'parent_id' => $request->parent_id ?? null,
            'title' => $request->title ?? null,
            'body' => $request->body,
        ]);

        return redirect()->back();
    }

    public function toggleCommentVote(Course $course, CourseComment $comment, Request $request)
    {
        // check if user has joined the course
        // $userCourse = UserCourse::where('user_id', auth()->id())
        //     ->where('course_id', $course->id)
        //     ->firstOrFail();
        abort_unless($course->joined(), 403, 'You have not joined this course');

        $request->validate([
            'is_upvote' => 'required|boolean',
        ]);

        $vote = $comment->votes()->where('user_id', auth()->id())->first();

        if ($vote) {
            if ($vote->is_upvote === $request->is_upvote) {
                $vote->delete();
            } else {
                $vote->update([
                    'is_upvote' => $request->is_upvote,
                ]);
            }
        } else {
            $comment->votes()->create([
                'course_comment_id' => $comment->id,
                'user_id' => auth()->id(),
                'is_upvote' => $request->is_upvote,
            ]);
        }

        return redirect()->back();
    }
}
