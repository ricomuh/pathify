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
        // $last_watched_episode = $this->faker->numberBetween(1, 10);

        return [
            'is_favorite' => $this->faker->boolean,
            // random percentage
            // 'last_watched_episode' => $this->faker->numberBetween(1, 10),
            // 'progress' => $this->faker->numberBetween(0, 100),
            'last_watched_at' => $this->faker->dateTimeThisYear,
            'completed_at' => $this->faker->dateTimeThisYear,
        ];
    }

    /**
     * Custom state to set progress based on episode count.
     *
     * @param int $episodeCount
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withProgress(int $episodeCount)
    {
        return $this->state(function (array $attributes) use ($episodeCount) {
            $lastWatchedEpisode = $this->faker->numberBetween(1, $episodeCount);
            $progress = ($lastWatchedEpisode / $episodeCount) * 100;

            return [
                'last_watched_episode' => $lastWatchedEpisode,
                'progress' => $progress,
            ];
        });
    }
}
