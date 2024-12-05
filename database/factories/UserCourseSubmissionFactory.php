<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserCourseSubmission>
 */
class UserCourseSubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // score
        $score = $this->faker->numberBetween(0, 100);

        // status
        $status = $this->faker->randomElement(['pending', $score > 70 ? 'approved' : 'rejected']);
        return [
            'file_path' => $this->faker->imageUrl(),
            // 'status' => $this->faker->randomElement(['pending', 'approved', 'rejected'])
            'score' => $score,
            'status' => $status,
        ];
    }
}
