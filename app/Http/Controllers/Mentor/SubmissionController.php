<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubmissionController extends Controller
{
    public function show(string $id)
    {
        return Inertia::render('Pages/Mentor/Submission/Show');
    }
}
