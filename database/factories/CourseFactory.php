<?php

namespace Database\Factories;

use App\Enums\CourseStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
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
        ];
    }
}
