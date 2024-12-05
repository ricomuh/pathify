<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MentorDetail>
 */
class MentorDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'profession' => $this->faker->word,
            'profession_at' => $this->faker->word,
            'description' => $this->faker->text,
        ];
    }
}
