<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseContent>
 */
class CourseContentFactory extends Factory
{
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
            'body' => '<p>' . implode('</p><p>', $this->faker->paragraphs(5)) . '</p>',
            'view_count' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
