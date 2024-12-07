<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseContent>
 */
class CourseContentFactory extends Factory
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
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            // the body field is a HTML content
            // 'body' => '<p>' . implode('</p><p>', $this->faker->paragraphs(5)) . '</p>',
            'body' => $this->body(),
            'view_count' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
