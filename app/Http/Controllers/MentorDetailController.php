<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class MentorDetailController extends Controller
{
    public function show(User $mentor)
    {
        abort_unless($mentor->isMentor(), 404);

        $mentor->load([
            'mentorDetail' => function ($query) {
                $query->with([
                    'socialLinks' => function ($query) {
                        $query->with([
                            'socialLink' => function ($query) {
                                $query->select('id', 'icon', 'name');
                            },
                        ]);
                    },
                ]);
            },
            // 'courses' => function ($query) {
            //     $query->published();
            //     $query->joined();
            //     $query->withCount('users');
            //     $query->with([
            //         'mentor' => function ($query) {
            //             $query->select('id', 'profile_picture', 'fullname', 'username');
            //             $query->with('mentorDetail');
            //         },
            //         'categories',
            //     ]);
            //     $query->latest();
            // },
        ]);

        $courses = Course::with([
            'mentor' => function ($query) {
                $query->select('id', 'profile_picture', 'fullname', 'username');
                $query->with('mentorDetail');
            },
            'categories',
            // 'joined'
        ])
            // ->when(auth()->check(), function ($query) {
            //     // $query->with('joined');
            // })
            ->published()
            // ->joined()
            ->withCount('users')
            ->where('mentor_id', $mentor->id)
            ->latest()
            ->get();

        return response()->json(compact('mentor', 'courses'));
        // return view('mentor-detail', compact('mentor'));
    }
}
