<?php

namespace Database\Seeders;

use App\Enums\CourseStatusEnum;
use App\Enums\RoleEnum;
use App\Models\Course;
use App\Models\CourseComment;
use App\Models\CourseCommentVote;
use App\Models\CourseTestimony;
use App\Models\User;
use App\Models\UserCourse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JsonCourseSeeder extends Seeder
{
    protected $file; // = file_get_contents(database_path('seed_datas/courses.json'));

    public function __construct()
    {
        $this->file = file_get_contents(database_path('seed_datas/courses.json'));
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(file_get_contents(database_path('seed_datas/courses.json')), true);

        $mentors = User::where('role_id', RoleEnum::Mentor)->get();
        $users = User::where('role_id', RoleEnum::User)->get();

        foreach ($data['courses'] as $course) {
            $this->command->info("Making course {$course['title']}");
            // $this->command->info(json_encode($course));
            try {
                $createdCourse = Course::factory()->create([
                    'status_id' => CourseStatusEnum::Published,
                    'title' => $course['title'],
                    'description' => $course['description'],
                    'mentor_id' => $mentors->random()->id,
                    'body' => $course['body'],
                    'requirements' => $course['requirements'],
                    'recommended' => $course['recommended'],
                    'level' => $course['level'],
                ]);
                $this->command->info("Course {$course['title']} has been created");

                $this->command->info("Applying categories to course {$course['title']}");
                foreach ($course['categories'] as $category) {
                    $createdCourse->categories()->attach($category);
                }

                $episode = 1;
                $groupOrder = 1;

                $attendees = $users->random(rand(8, 20));
                $createdCourse->users()->attach($attendees);

                foreach ($course['groups'] as $group) {
                    $this->command->info("Creating group {$group['title']} for course {$course['title']}");
                    $contentGroup = $createdCourse->groups()->create([
                        'title' => $group['title'],
                        'order' => $groupOrder++,
                    ]);

                    foreach ($group['contents'] as $content) {
                        $this->command->info("Creating content {$content['title']} for group {$group['title']} in course {$course['title']}");
                        $createdContent = $contentGroup->contents()->create([
                            'course_id' => $createdCourse->id,
                            'title' => $content['title'],
                            'description' => $content['description'],
                            'order' => $episode++,
                            'body' => $content['body'],
                        ]);

                        $this->command->info("Creating comments for content {$content['title']} in course {$course['title']}");
                        CourseComment::factory(rand(0, 5))->create([
                            'course_content_id' => $createdContent->id,
                            'user_id' => $attendees->random()->id,
                            'course_id' => $createdCourse->id,
                        ])->each(function ($comment) use ($attendees) {
                            collect(range(1, rand(0, 5)))->each(function () use ($comment, $attendees) {
                                CourseCommentVote::factory()->create([
                                    'course_comment_id' => $comment->id,
                                    'user_id' => $attendees->random()->id,
                                    'is_upvote' => 1
                                ]);
                            });

                            CourseComment::factory(rand(1, 3))->create([
                                'course_content_id' => $comment->course_content_id,
                                'user_id' => $attendees->random()->id,
                                'course_id' => $comment->course_id,
                                'parent_id' => $comment->id,
                            ])->each(function ($reply) use ($attendees) {
                                collect(range(1, rand(1, 5)))->each(function () use ($reply, $attendees) {
                                    CourseCommentVote::factory()->create([
                                        'course_comment_id' => $reply->id,
                                        'user_id' => $attendees->random()->id,
                                    ]);
                                });
                            });
                        });
                    }
                }

                $this->command->info("Creating attendees for course {$course['title']}");
                $attendees->each(function ($user) use ($createdCourse, $episode) {
                    UserCourse::factory()
                        ->withProgress($episode)
                        ->create([
                            'user_id' => $user->id,
                            'course_id' => $createdCourse->id,
                        ]);

                    CourseTestimony::factory()->create([
                        'course_id' => $createdCourse->id,
                        'user_id' => $user->id,
                    ]);
                });

                $this->command->info("Course {$course['title']} has been created");
            } catch (\Exception $e) {
                $this->command->error("Error creating course {$course['title']}: " . $e->getMessage());
            }
        }
    }
}
