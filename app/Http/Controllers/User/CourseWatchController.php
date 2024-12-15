<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseContent;
use App\Models\CourseSubmission;
use App\Models\UserCourse;
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
            'groups' => function ($query) {
                $query->orderBy('order', 'asc');
                // $query->select('id', 'course_id', 'title', 'order');
                $query->with([
                    'contents' => function ($query) {
                        $query->orderBy('order', 'asc');
                        $query->select('id', 'course_id', 'group_id', 'title', 'description', 'order');
                    }
                ]);
            },
            'testimonies' => function ($query) {
                $query->with([
                    'user' => function ($query) {
                        $query->select('id', 'fullname', 'username', 'profile_picture');
                    },
                ]);
            },
            'joined'
            // 'contents' => function ($query) {
            //     $query->orderBy('order', 'asc');
            //     $query->select('id', 'course_id', 'title', 'description', 'order');
            // }
        ])->loadCount('users')->get();


        $courseCategories = $course->categories->pluck('id')->toArray();

        $relatedCourses = Course::with([
            'mentor' => function ($query) {
                $query->select('id', 'fullname', 'username', 'profile_picture');
                $query->with('mentorDetail');
            },
            'categories',
        ])
            ->published()
            ->whereHas('categories', function ($q) use ($courseCategories) {
                $q->whereIn('categories.id', $courseCategories);
            })
            ->inRandomOrder()
            ->where('id', '!=', $course->id)
            ->limit(4)
            ->get();

        // return response()->json(compact('course', 'courseCategories', 'relatedCourses'));
        // check if user has access to this course
        // $hasAccess = auth()->user()->hasAccess($course);
        // dd(compact('course', 'hasAccess'));

        // return response()->json(compact('course', 'hasAccess', 'relatedCourses'));

        return Inertia::render('Course/DetailCourse', compact('course', 'relatedCourses'));
    }

    public function join(Course $course)
    {
        $course->load([
            'joined'
        ]);

        // abort if user already joined
        // abort_if(!$course->joined, 403);


        // abort_unless(UserCourse::where('user_id', auth()->id())->where('course_id', $course->id)->exists(), 403);

        UserCourse::create([
            'user_id' => auth()->id(),
            'course_id' => $course->id,
        ]);

        return redirect()->route('courses.show.show', $course->slug);
    }

    public function watch(Course $course, int $order)
    {
        // abort_unless(auth()->user()->hasAccess($course), 403);

        // // disable access if the last_watch is not the same as the current order
        // $userCourse = UserCourse::where('user_id', auth()->id())
        //     ->where('course_id', $course->id)
        //     ->firstOrFail();

        // abort_unless($userCourse->last_watched_episode < $order, 403);

        // // $owned = auth()->user()->access()
        // $course->access($order);

        $course->load([
            'mentor' => function ($query) {
                $query->select('id', 'fullname', 'username', 'profile_picture');
            },
            // 'status',
            // 'categories',
            // 'contents' => function ($query) {
            //     $query->orderBy('order', 'asc');
            //     $query->select('id', 'course_id', 'title', 'description', 'order');
            // }
            'groups' => function ($query) {
                $query->orderBy('order', 'asc');
                // $query->select('id', 'course_id', 'title', 'order');
                $query->with([
                    'contents' => function ($query) {
                        $query->orderBy('order', 'asc');
                        $query->select('id', 'course_id', 'group_id', 'title', 'description', 'order');
                    }
                ]);
            },
            'joined'
        ]);
        // dd(compact('course', 'order'));

        abort_unless($course->joined, 403);



        $content = CourseContent::where('course_id', $course->id)
            ->where('order', $order)
            ->with([
                'comments' => function ($query) {
                    // apply search
                    $query->when(request('search'), function ($query, $search) {
                        $query->where('content', 'like', '%' . $search . '%');
                    });
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
                    $query->latest();
                },

            ])
            ->firstOrFail();

        $update = [
            'last_watched_at' => now(),
        ];

        if ($course->joined->last_watched_episode < $order) {
            $update['last_watched_episode'] = $order;
            $update['progress'] = $order / $course->contents->count() * 100;
        }

        // dd($course);
        // $course->dd();
        $course->joined->update($update);
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

        // set $nextEpisode link, set to submission if the last episode
        $nextEpisode = $order + 1;
        $nextEpisode = $nextEpisode > $course->contents->count() ? route('courses.show.submission', $course->slug) : route('courses.show.watch', [$course->slug, $nextEpisode]);

        $prevEpisode = $order - 1;
        $prevEpisode = $prevEpisode < 1 ? route('courses.show.show', $course->slug) : route('courses.show.watch', [$course->slug, $prevEpisode]);

        // dd(compact('course', 'content'));
        // return response()->json(compact('course', 'content', 'order'));
        // echo "hello";
        return Inertia::render('Course/WatchCourse', compact('course', 'content', 'order', 'nextEpisode', 'prevEpisode'));
    }

    public function next(Course $course, Request $request)
    {
        $request->validate([
            'order' => 'required|integer',
        ]);

        $episode_count = $course->contents->count();
        $order = $request->order + 1;

        if ($order > $episode_count) {
            return redirect()->route('courses.show.submission', $course->slug);
        }

        $userCourse = UserCourse::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->firstOrFail();

        abort_unless($userCourse->last_watched_episode + 1 < $order, 403);

        // if the order is not the last watched episode, update the last watched episode
        if ($userCourse->last_watched_episode < $order) {
            $userCourse->update([
                'last_watched_episode' => $order,
            ]);
        }
        // $userCourse->update([
        //     'last_watched_episode' => $order,
        // ]);

        return redirect()->route('courses.show.watch', [$course->slug, $order]);
    }

    public function submission(Course $course)
    {
        abort_unless(auth()->user()->hasAccess($course), 403);

        $course->load([
            'mentor' => function ($query) {
                $query->select('id', 'fullname', 'username', 'profile_picture');
            },
            'groups' => function ($query) {
                $query->orderBy('order', 'asc');
                // $query->select('id', 'course_id', 'title', 'order');
                $query->with([
                    'contents' => function ($query) {
                        $query->orderBy('order', 'asc');
                        $query->select('id', 'course_id', 'group_id', 'title', 'description', 'order');
                    }
                ]);
            },
        ]);

        $submission = CourseSubmission::where('course_id', $course->id)
            ->with([
                'userCourseSubmissions' => function ($query) {
                    $query->where('user_id', auth()->id());
                }
            ])
            ->first();

        // return response()->json(compact('course', 'submission'));
        return Inertia::render('Course/WatchCourse', compact('course', 'submission'));
    }
}
