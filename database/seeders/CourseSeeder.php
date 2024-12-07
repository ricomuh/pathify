<?php

namespace Database\Seeders;

use App\Enums\CourseStatusEnum;
use App\Models\Course;
use App\Models\CourseComment;
use App\Models\CourseCommentVote;
use App\Models\CourseContent;
use App\Models\CourseContentGroup;
use App\Models\CourseSubmission;
use App\Models\CourseTestimony;
use App\Models\UserCourse;
use App\Models\UserCourseSubmission;
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
        $courseCategoryParents = \App\Models\Category::whereNull('parent_id')->get();
        $courseCategories = \App\Models\Category::whereNotNull('parent_id')->get();

        // make courses
        $this->command->info('Making courses...');
        $courses = Course::factory(30)->create([
            'status_id' => CourseStatusEnum::Published,
            'mentor_id' => $mentors->random()->id,
        ]);

        $this->command->info('Making course submissions, content, comments, votes, and replies.... attaching users, mentors, categories...');
        $courses->each(function ($course) use ($mentors, $courseCategoryParents, $courseCategories, $users) {
            // attach mentor
            $mentor = $mentors->random();
            $course->mentor_id = $mentor->id;
            $course->save();

            // attach users
            $this->command->info("Attaching users to the course {$course->title}");
            $users = $users->random(rand(8, 20));
            $users->each(function ($user) use ($course) {
                UserCourse::factory()->create([
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                ]);
                // make course testimonies
                // $this->command->info("Making course testimonies for the course {$course->title}");
                CourseTestimony::factory()->create([
                    'course_id' => $course->id,
                    'user_id' => $user->id,
                ]);
            });

            $this->command->info("Making course submission for the course {$course->title}");
            $courseSubmission = CourseSubmission::factory()->create([
                'course_id' => $course->id,
            ]);

            // make user course submissions
            $this->command->info("Making user course submissions for the course {$course->title}");
            $users->each(function ($user) use ($courseSubmission, $course) {
                // log to the terminal
                // $this->command->info("User ID: {$user->id} - Course ID: {$course->id}");
                $userCourseSubmission = UserCourseSubmission::factory()->create([
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                    'course_submission_id' => $courseSubmission->id,
                ]);
            });

            // attach 1 parent category
            $courseCategoryParent = $courseCategoryParents->random();
            $course->categories()->attach($courseCategoryParent->id);

            // attach several categories
            $courseCategories->random(rand(1, 3))->each(function ($category) use ($course) {
                $course->categories()->attach($category->id);
            });

            // make content
            $this->command->info("Making course content for the course {$course->title}");
            $episode = 1;
            CourseContentGroup::factory(rand(3, 5))->create([
                'course_id' => $course->id,
            ])->each(function ($group, $index) use ($course, $users, &$episode) {
                $group->order = $index + 1;
                $group->save();
                CourseContent::factory(rand(3, 10))->create([
                    'course_id' => $course->id,
                    'group_id' => $group->id,
                ])->each(function ($content) use ($users, $course, &$episode) {
                    $content->order = $episode++;
                    $content->save();
                    // make comments
                    $this->command->info("Making comments, replies, and votes for the content {$content->title}");
                    CourseComment::factory(rand(1, 5))->create([
                        'course_content_id' => $content->id,
                        'user_id' => $users->random()->id,
                        'course_id' => $course->id,
                    ])->each(function ($comment) use ($users) {
                        // for each random numbers
                        collect(range(1, rand(1, 5)))->each(function () use ($comment, $users) {
                            CourseCommentVote::factory()->create([
                                'course_comment_id' => $comment->id,
                                'user_id' => $users->random()->id,
                            ]);
                        });

                        // make replies
                        CourseComment::factory(rand(1, 3))->create([
                            'course_content_id' => $comment->course_content_id,
                            'user_id' => $users->random()->id,
                            'course_id' => $comment->course_id,
                            'parent_id' => $comment->id,
                        ])->each(function ($reply) use ($users) {
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
        });
    }
}
