<?php

namespace Database\Factories;

use App\Models\SocialLink;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MentorSocialLink>
 */
class MentorSocialLinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // get random social link
        $socialLink = SocialLink::inRandomOrder()->first();

        // set url (replace {username} or {phone} or {domain} with random value)
        $url = $socialLink->url;
        $url = str_replace('{username}', $this->faker->userName, $url);
        $url = str_replace('{phone}', $this->faker->phoneNumber, $url);
        $url = str_replace('{domain}', $this->faker->domainName, $url);

        return [
            'social_link_id' => $socialLink->id,
            'url' => $url,
        ];
    }
}
