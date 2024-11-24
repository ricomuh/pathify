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
                    }
                ]);
            }
        ]);

        return Inertia::render('Course/ListCourse', [
            'courses' => $courses
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');

        $courses = Course::with([
            'mentor',
            'status',
            'categories',
            'contents' => function ($query) {
                $query->latest();
                $query->with([
                    'comments' => function ($query) {
                        $query->withCount([
                            'upvotes as upvotes' => function ($query) {
                                $query->where('is_upvote', true);
                            },
                            'downvotes as downvotes' => function ($query) {
                                $query->where('is_upvote', false);
                            }
                        ]);
                    }
                ]);
            }
        ])
        ->where('name', 'like', '%' . $query . '%')
        ->orWhereHas('categories', function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%');
        })
        ->get();

        return Inertia::render('Course/SearchCourse', [
            'query' => $query,
            'courses' => $courses,
        ]);
    }

    public function show($id)
    {
        return Inertia::render('Course/DetailCourse');
    }
}