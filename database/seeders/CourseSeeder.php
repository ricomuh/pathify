<?php

namespace Database\Seeders;

use App\Enums\CourseStatusEnum;
use App\Models\Course;
use App\Models\CourseComment;
use App\Models\CourseCommentVote;
use App\Models\CourseContent;
use App\Models\UserCourse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            CourseStatusSeeder::class,
            CourseCategorySeeder::class,
        ]);

        // get mentors
        $mentors = \App\Models\User::where('role_id', \App\Enums\RoleEnum::Mentor)->get();

        // users and mentors
        $users = \App\Models\User::where('role_id', \App\Enums\RoleEnum::User)->get();

        $courseStatuses = \App\Models\CourseStatus::all();
        $courseCategories = \App\Models\Category::all();

        // make courses
        $courses = Course::factory(10)->create([
            'status_id' => CourseStatusEnum::Published,
            'mentor_id' => $mentors->random()->id,
        ]);

        $courses->each(function ($course) use ($mentors, $courseCategories, $users) {
            // attach mentor
            $mentor = $mentors->random();
            $course->mentor_id = $mentor->id;
            $course->save();

            // attach users
            $attendingUsers = $users->random(rand(1, 5));
            $attendingUsers->each(function ($user) use ($course) {
                UserCourse::factory()->create([
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                ]);
            });

            // attach several categories
            $courseCategories->random(rand(1, 3))->each(function ($category) use ($course) {
                $course->categories()->attach($category->id);
            });

            // make content
            $contents = CourseContent::factory(rand(3, 10))->create([
                'course_id' => $course->id,
            ]);
            $contents->each(function ($content, $index) use ($users, $course) {
                $content->order = $index + 1;
                $content->save();
                // make comments
                $comments = CourseComment::factory(rand(1, 5))->create([
                    'course_content_id' => $content->id,
                    'user_id' => $users->random()->id,
                    'course_id' => $course->id,
                ]);

                $comments->each(function ($comment) use ($users) {
                    // for each random numbers
                    collect(range(1, rand(1, 5)))->each(function () use ($comment, $users) {
                        CourseCommentVote::factory()->create([
                            'course_comment_id' => $comment->id,
                            'user_id' => $users->random()->id,
                        ]);
                    });

                    // make replies
                    $replies = CourseComment::factory(rand(1, 3))->create([
                        'course_content_id' => $comment->course_content_id,
                        'user_id' => $users->random()->id,
                        'course_id' => $comment->course_id,
                        'parent_id' => $comment->id,
                    ]);

                    $replies->each(function ($reply) use ($users) {
                        // for each random numbers
                        collect(range(1, rand(1, 5)))->each(function () use ($reply, $users) {
                            CourseCommentVote::factory()->create([
                                'course_comment_id' => $reply->id,
                                'user_id' => $users->random()->id,
                            ]);
                        });
                    });
                });
            });
        });
    }
}
