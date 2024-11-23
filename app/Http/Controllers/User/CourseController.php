<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with([
            'mentor',
            'status',
            'categories',
            'contents' => function ($query) {
                $query->latest();
                $query->with([
                    'comments' => function ($query) {
                        // with upvotes and downvotes (count model CourseCommentVote)
                        $query->withCount([
                            'upvotes as upvotes' => function ($query) {
                                $query->where('is_upvote', true);
                            },
                            'downvotes as downvotes' => function ($query) {
                                $query->where('is_upvote', false);
                            }
                        ]);
                        // and check if user has voted
                        // call scopeVoted from CourseComment model
                    }
                ]);
            }
        ]);

        return Inertia::render('Course/ListCourse', [
            'courses' => $courses
        ]);
    }
}