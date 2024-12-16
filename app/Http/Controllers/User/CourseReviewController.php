<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseTestimony;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseReviewController extends Controller
{
    public function create(Course $course)
    {
        // check if user has already finished the course
        $course->load('joined');
        $course->loadCount('contents');

        $course->joined->completed_at = now();
        $course->joined->save();

        // abort_unless($course->joined->completed_at, 403, 'You can only review course that you have completed.');

        return Inertia::render('Course/Review', compact('course'));
        // return view('user.course-review.create');
    }

    public function store(Request $request, Course $course)
    {
        // check if user has already finished the course
        $course->load('joined');

        abort_unless($course->joined->completed_at, 403, 'You can only review course that you have completed.');

        // validate request
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'body' => 'required|string',
        ]);

        // store review
        // $course->testimonies()->create([
        //     'user_id' => auth()->id(),
        //     'rating' => $request->rating,
        //     'body' => $request->body,
        // ]);
        CourseTestimony::create([
            'user_id' => auth()->id(),
            'course_id' => $course->id,
            'rating' => $request->rating,
            'body' => $request->body,
        ]);

        return redirect()->route('courses.show.certificate', $course->slug);
    }
}
