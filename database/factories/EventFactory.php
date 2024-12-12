<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $start = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $regisStart = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $regisEnd = $this->faker->dateTimeBetween($regisStart, '+1 month');
        $start = $this->faker->dateTimeBetween($regisEnd, '+1 month');
        /**
         * rundown:
         * [
         * ['18:00', '19:00', 'Opening'],
         * ['19:00', '19:30', 'Session 1'],
         * ]
         */
        // generate random rundown
        $rundown = [];
        $time = $start->modify('+1 hour');
        for ($i = 0; $i < 5; $i++) {
            $end = $time->modify('+1 hour');
            $rundown[] = [
                $time->format('H:i'),
                $end->format('H:i'),
                $this->faker->sentence(),
            ];
            $time = $end;
        }

        $is_online = $this->faker->boolean();

        if ($is_online) {
            $platform = $this->faker->randomElement(['Zoom', 'Google Meet', 'Microsoft Teams']);
            $link = $this->faker->url;
        } else {
            // $location = $this->faker->address;
            $locationName = $this->faker->company;
            $locationAddress = $this->faker->address;
        }

        $faqs = [];
        for ($i = 0; $i < 3; $i++) {
            $faqs[] = [
                'question' => $this->faker->sentence(),
                'answer' => $this->faker->paragraph(),
            ];
        }

        return [
            'event_category_id' => $this->faker->numberBetween(1, 4),
            'thumbnail' => $this->faker->imageUrl(),
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraphs(3, true),
            'start_date' => $start,
            'end_date' => $start->modify('+3 hours'),
            // add 1 to 3 hours to start date
            // 'end_date' => $this->faker->dateTimeBetween($start, $start->modify('+3 hours')),
            'quota' => $this->faker->numberBetween(100, 150),
            // 'location' => $this->faker->address,
            'is_online' => $is_online,
            'platform' => $platform ?? null,
            'link' => $link ?? null,
            'location_name' => $locationName ?? null,
            'location_address' => $locationAddress ?? null,
            // 'registration_start_date' => $this->faker->dateTimeBetween('-1 month', $start),
            // 'registration_end_date' => $this->faker->dateTimeBetween($start, '+1 month'),
            'registration_start_date' => $regisStart,
            'registration_end_date' => $regisEnd,
            'status' => $this->faker->randomElement(['draft', 'published']),
            'rundown' => $rundown,
            'faqs' => $faqs,
        ];
    }
}
