<?php

namespace Database\Seeders;

use App\Enums\CourseStatusEnum;
use App\Enums\RoleEnum;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseComment;
use App\Models\CourseCommentVote;
use App\Models\CourseSubmission;
use App\Models\CourseTestimony;
use App\Models\User;
use App\Models\UserCourse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use GeminiAPI\Client;
use GeminiAPI\Resources\ModelName;
use GeminiAPI\Resources\Parts\TextPart;
use Illuminate\Support\Facades\Log;

class RealCourseSeeder extends Seeder
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client($_ENV['GEMINI_API_KEY']);
    }

    public function generatePrompt(string $category)
    {
        $parentCategories = Category::parentOnly()->get();
        $childCategories = Category::whereNotNull('parent_id')->get();

        $format = [
            'categories' => "Please select a category or multiple categories for the course. You can select multiple categories. Select 1 for a parent category and multiple for child categories. Always use array format, and only use the ID of the category. e.g. [1, 2, 3]",
            "title" => "Please enter the title of the course.",
            "thumbnail" => "Please enter the URL of the course thumbnail.",
            "description" => "Please enter the description of the course.",
            "requirements" => ["Please enter the requirements of the course. You can enter multiple requirements."],
            "recommended" => ["Please enter the recommended people categories for the course. You can enter multiple categories."],
            "level" => "Please enter the level of the course. 1 for beginner, 2 for intermediate, and 3 for advanced.",
            "groups" => [
                [
                    "title" => "Please enter the title of the content group. this group supposed to group the content of the course. e.g. Introduction, Chapter 1: Getting Started, etc.",
                    "contents" => [
                        [
                            "title" => "Please enter the title of the content. e.g. Introduction to Programming",
                            'description' => "Please enter the description of the content. e.g. This is the introduction to programming.",
                            "body" => "Please enter the body of the content. It has to be proper HTML format. You can use Heading 1, Heading 2, Paragraph, Links, images, or even embed youtube videos. NEED TO BE PROPER HTML FORMAT NOT MARKDOWN. e.g. <h1>Introduction to Programming</h1><p>This is the introduction to programming.</p>. minimum 100 words.",
                        ]
                    ]
                ]
            ],
        ];

        $json = json_encode($format, JSON_PRETTY_PRINT);
        // merge the category but differentiating the parent and child categories
        $categories =  [
            'parentCategories' => $parentCategories->toArray(),
            'childCategories' => $childCategories->toArray(),
        ];

        $categoriesJson = json_encode($categories, JSON_PRETTY_PRINT);

        $prompt = "You will be asked to generate a course based on the prompt provided. Please provide the JSON format based on the format provided. Your response will be dummy data for my database. generate me a course for the category: $category\n\n with the following format:\n\n\n$json\n\n\nCategories:\n\n\n$categoriesJson\n. Give me the JSON format, based on the format I provided. DO NOT PUT ANYTHING ELSE. EITHER IN THE FIRST LINE OR THE LAST LINE. JUST THE JSON FORMAT.
        DON'T START THE RESPONSE BY GIVING ```json or something like that, because I will parse the response based on the JSON format.";

        return $prompt;
    }

    public function parseResponse(string $response)
    {
        // get the first { until the last }
        $json = substr($response, strpos($response, '{'), strrpos($response, '}') - strpos($response, '{') + 1);

        return json_decode($json, true);
    }

    // public function canBeParsed(string $response)
    // {
    //     try {
    //         $get = $this->parseResponse($response);
    //         // return true;
    //         return !empty($get);
    //     } catch (\Exception $e) {
    //         return false;
    //     }
    // }
    public function parse($response)
    {
        try {
            $get = json_decode($response, true);
            return $get;
        } catch (\Exception $e) {
            throw new \Exception("Failed to parse the response. Please try again.");
        }
    }


    public function askAI(string $prompt)
    {
        $done = false;
        $response = "";
        $attempts = 0;

        $originalPrompt = $prompt;

        while (!$done) {
            if ($attempts > 3) {
                $this->command->error("Failed to generate the course. Please try again later.");
                break;
            }

            if ($attempts > 0) {
                $this->command->info("Retrying to generate the course...");
                $prompt = "Please try again to generate the course. The previous response isn't finished. Just continue the previous response. Don't copy the previous response, just continue the previous response. The prompt is $originalPrompt . The previous response is $response";

                // $this->command->info("Prompt: $prompt");
            }

            $response .= $this->client->generativeModel(ModelName::GEMINI_PRO)
                ->generateContent(
                    new TextPart($prompt),
                )->text();

            // try to parse the response
            try {
                $get = $this->parse($response);
                $done = true;
            } catch (\Exception $e) {
                $this->command->error($e->getMessage());
                $attempts++;
            }
        }

        return $response;
        // $response = $this->client->generativeModel(ModelName::GEMINI_PRO)
        //     // ->withSystemInstruction('You will be asked to generate a course based on the prompt provided. Please provide the JSON format based on the format provided. Your response will be dummy data for my database.')
        //     ->generateContent(
        //         new TextPart($prompt),
        //     );

        // return $response->text();
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            CourseStatusSeeder::class,
            CourseCategorySeeder::class,
        ]);

        $parentCategories = Category::parentOnly()->get();

        $mentors = User::where('role_id', RoleEnum::Mentor)->get();
        $users = User::where('role_id', \App\Enums\RoleEnum::User)->get();

        // generate prompt for each parent category 2-5 times
        foreach ($parentCategories as $category) {
            $prompt = $this->generatePrompt($category->name);

            for ($i = 0; $i < rand(5, 10); $i++) {
                $attendees = $users->random(rand(8, 20));
                $response = $this->askAI($prompt);
                $data = $this->parse($response);

                if (empty($data)) {
                    // $this->command->info("Skipping the category {$category->name}");
                    // save the response to the laravel log
                    // Log::info("Failed to generate the course for the category {$category->name}. Response: $response");
                    // continue;

                    // try to parse the response
                    $data = $this->parseResponse($response);

                    if (empty($data)) {
                        $this->command->error("Failed to parse the response. Skipping the category {$category->name}");
                        Log::info("Failed to parse the response. Skipping the category {$category->name}. Response: $response");
                        continue;
                    }
                }

                $this->command->info("Making course for the category {$category->name}");
                $this->command->info("Data: " . json_encode($data, JSON_PRETTY_PRINT));

                // save the data to the database
                // save the course
                $course = Course::factory()->create([
                    'status_id' => CourseStatusEnum::Published,
                    'mentor_id' => $mentors->random()->id,
                    'title' => $data['title'],
                    // 'thumbnail' => $data['thumbnail'],
                    'description' => $data['description'],
                    // 'body' => $data['body'],
                    'requirements' => $data['requirements'],
                    'recommended' => $data['recommended'],
                    'level' => $data['level'],
                ]);

                // category
                foreach ($data['categories'] as $categoryId) {
                    $course->categories()->attach($categoryId);
                }

                // $course->mentor_id = $mentors->random()->id;

                $episode = 1;
                $groupOrder = 1;

                // save the groups
                foreach ($data['groups'] as $group) {
                    $courseGroup = $course->groups()->create([
                        'order' => $groupOrder++,
                        'title' => $group['title'],
                    ]);

                    // save the contents
                    foreach ($group['contents'] as $content) {
                        $content = $courseGroup->contents()->create([
                            'course_id' => $course->id,
                            'order' => $episode++,
                            'title' => $content['title'],
                            'description' => $content['description'],
                            'body' => $content['body'],
                        ]);

                        CourseComment::factory(rand(0, 5))->create([
                            'course_content_id' => $content->id,
                            'user_id' => $attendees->random()->id,
                            'course_id' => $course->id,
                        ])->each(function ($comment) use ($attendees) {
                            // for each random numbers
                            collect(range(1, rand(0, 5)))->each(function () use ($comment, $attendees) {
                                CourseCommentVote::factory()->create([
                                    'course_comment_id' => $comment->id,
                                    'user_id' => $attendees->random()->id,
                                    'is_upvote' => 1
                                ]);
                            });

                            // make replies
                            CourseComment::factory(rand(1, 3))->create([
                                'course_content_id' => $comment->course_content_id,
                                'user_id' => $attendees->random()->id,
                                'course_id' => $comment->course_id,
                                'parent_id' => $comment->id,
                            ])->each(function ($reply) use ($attendees) {
                                // for each random numbers
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

                $courseSubmission = CourseSubmission::factory()->create([
                    'course_id' => $course->id,
                ]);

                $attendees->each(function ($user) use ($course, $episode) {
                    UserCourse::factory()
                        ->withProgress($episode)
                        ->create([
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

                // save the reviews
                // foreach ($data['reviews'] as $review) {
                //     $course->testimonies()->create([
                //         'rating' => $review['rating'],
                //         'body' => $review['body'],
                //     ]);
                // }

                // // save the submission
                // $course->submission()->create([
                //     'title' => $data['submission']['title'],
                //     'body' => $data['submission']['body'],
                // ]);
            }
        }
    }
}
