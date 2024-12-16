<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCertificate;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class CourseCertificateController extends Controller
{
    public function show(Course $course)
    {
        // check if user has already finished the course
        $course->load('joined');

        abort_unless($course->joined->completed_at, 403, 'You can only download certificate for course that you have completed.');

        // check if user has already reviewed the course
        $testimony = $course->testimonies->where('user_id', auth()->id())->first();

        abort_unless($testimony, 403, 'You can only download certificate for course that you have reviewed.');

        // create certificate pdf
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('user.course-certificate.show', ['title' => $course->title, 'name' => auth()->user()->name]);
        return $pdf->download('certificate - ' . $course->title . '.pdf');

        // check if there is already certificate
        $exists = CourseCertificate::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->first();

        if (!$exists) {
        }

        // return view('user.course-certificate.show', compact('course'));

        // create certificate pdf
        // $pdf = PDF::loadView('user.course-certificate.show', compact('course'));
    }
}
