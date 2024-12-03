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
        // dd(compact('course', 'hasAccess'));

        return response()->json(compact('course', 'hasAccess'));

        return Inertia::render('Course/DetailCourse', compact('course', 'hasAccess'));
    }

    public function watch(Course $course, int $order)
    {
        abort_unless(auth()->user()->hasAccess($course), 403);

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
            // ->with([
            //     'comments' => function ($query) {
            //         $query->whereNull('parent_id');
            //         $query->with([
            //             'user',
            //             'voted',
            //             'children' => function ($query) {
            //                 $query->with([
            //                     'user',
            //                     'voted',
            //                 ]);
            //                 $query->withCount([
            //                     'upvotes',
            //                     'downvotes',
            //                 ]);
            //             },
            //         ]);
            //         $query->withCount([
            //             'upvotes',
            //             'downvotes',
            //         ]);
            //     }
            // ])
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
