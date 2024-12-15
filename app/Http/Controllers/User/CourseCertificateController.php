<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseCertificateController extends Controller
{
    public function show(Course $course)
    {
        // check if user has already finished the course
        $course->load('joined');

        abort_unless($course->joined->completed_at, 403, 'You can only download certificate for course that you have completed.');

        // return view('user.course-certificate.show', compact('course'));

        // create certificate pdf
        // $pdf = PDF::loadView('user.course-certificate.show', compact('course'));
    }
}
