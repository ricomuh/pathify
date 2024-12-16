<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'reportable_id' => 1,
            'reportable_type' => 'App\Models\CourseComment',
            'reason' => $this->faker->word,
            'description' => $this->faker->paragraph,
        ];
    }
}
