<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserCourse>
 */
class UserCourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'is_favorite' => $this->faker->boolean,
            // random percentage
            'progress' => $this->faker->numberBetween(0, 100),
            'last_watched_at' => $this->faker->dateTimeThisYear,
            'completed_at' => $this->faker->dateTimeThisYear,
        ];
    }
}
