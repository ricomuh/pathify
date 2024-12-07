<?php

namespace Database\Factories;

use App\Enums\CourseStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    // generate body content. it contains html: heading, paragraph, image, and yt video
    private function section(): string
    {
        $heading = $this->faker->sentence();
        $paragraph = $this->faker->paragraph();
        $image = $this->faker->imageUrl();
        $video = 'https://www.youtube.com/watch?v=' . $this->faker->regexify('[A-Za-z0-9]{11}');

        return <<<HTML
            <h2>$heading</h2>
            <p>$paragraph</p>
            <img src="$image" alt="$heading">
            <iframe width="560" height="315" src="$video" title="$heading" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        HTML;
    }

    // randomize the body content (3-5 sections)
    private function body(): string
    {
        $sections = $this->faker->numberBetween(3, 5);
        $body = '';
        for ($i = 0; $i < $sections; $i++) {
            $body .= $this->section();
        }
        return $body;
    }


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence();
        return [
            'status_id' => CourseStatusEnum::Published,
            'thumbnail' => $this->faker->imageUrl(),
            'title' => $title,
            'description' => $this->faker->paragraph(),
            'level' => $this->faker->randomElement([1, 2, 3]),
            'body' => $this->faker->paragraphs(3, true),
            // 'body' => $this->body(),
            'requirements' => $this->faker->sentences(3),
            'recommended' => $this->faker->sentences(3),
        ];
    }
}
