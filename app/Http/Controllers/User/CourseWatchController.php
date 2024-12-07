<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseContent;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseWatchController extends Controller
{
    public function show(Course $course)
    {
        $course->load([
            'mentor' => function ($query) {
                $query->select('id', 'fullname', 'username', 'profile_picture');
                $query->with('mentorDetail');
            },
            'status',
            'categories',
            'contents' => function ($query) {
                $query->orderBy('order', 'asc');
                $query->select('id', 'course_id', 'title', 'description', 'order');
            }
        ])->loadCount('users');


        $latestCourses = Course::with([
            'mentor' => function ($query) {
                $query->select('id', 'profile_picture', 'fullname', 'username');
                $query->with('mentorDetail');
            },
            'categories',
        ])
            ->published()
            ->latest()->limit(4)->get();

        // check if user has access to this course
        $hasAccess = auth()->user()->hasAccess($course);
        // dd(compact('course', 'hasAccess'));

        // return response()->json(compact('course', 'hasAccess'));

        return Inertia::render('Course/DetailCourse', compact('course', 'hasAccess', 'latestCourses'));
    }

    public function watch(Course $course, int $order)
    {
        abort_unless(auth()->user()->hasAccess($course), 403);
        // $owned = auth()->user()->access()
        $course->access($order);

        $course->load([
            'mentor' => function ($query) {
                $query->select('id', 'fullname', 'username', 'profile_picture');
            },
            // 'status',
            // 'categories',
            'contents' => function ($query) {
                $query->orderBy('order', 'asc');
                $query->select('id', 'course_id', 'title', 'description', 'order');
            }
        ])->loadCount('users');

        $content = CourseContent::where('course_id', $course->id)
            ->where('order', $order)
            ->with([
                'comments' => function ($query) {
                    $query->with([
                        'user' => function ($query) {
                            $query->select('id', 'fullname', 'username', 'profile_picture');
                        },
                        'voted' => function ($query) {
                            $query->select('course_comment_id', 'is_upvote');
                        },
                    ]);
                    $query->withCount([
                        'upvotes',
                        'downvotes',
                    ]);
                }
            ])
            ->firstOrFail();

        // calculate total votes each comment
        $content->comments->each(function ($comment) {
            $comment->votes = $comment->upvotes_count - $comment->downvotes_count;
        });

        // organize comments children to parent
        $comments = $content->comments->groupBy('parent_id');

        $content->comments = $comments->get(null, collect())->map(function ($comment) use ($comments) {
            $comment->children = $comments->get($comment->id, collect());
            return $comment;
        });

        $content->increment('view_count');

        // dd(compact('course', 'content'));
        return response()->json(compact('course', 'content'));
        // echo "hello";
        // return Inertia::render('Course/WatchCourse', compact('course', 'content'));
    }
}