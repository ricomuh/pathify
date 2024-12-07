<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $socials = collect([
            [
                'icon' => 'fab fa-facebook',
                'color' => '#1877f2',
                'url' => 'https://facebook.com/{username}',
                'name' => 'Facebook',
            ],
            [
                'icon' => 'fab fa-twitter',
                'color' => '#1da1f2',
                'url' => 'https://twitter.com/{username}',
                'name' => 'Twitter',
            ],
            [
                'icon' => 'fab fa-instagram',
                'color' => '#c13584',
                'url' => 'https://instagram.com/{username}',
                'name' => 'Instagram',
            ],
            [
                'icon' => 'fab fa-linkedin',
                'color' => '#0a66c2',
                'url' => 'https://linkedin.com/in/{username}',
                'name' => 'LinkedIn',
            ],
            [
                'icon' => 'fab fa-github',
                'color' => '#333',
                'url' => 'https://github.com/{username}',
                'name' => 'GitHub',
            ],
            [
                'icon' => 'fab fa-youtube',
                'color' => '#ff0000',
                'url' => 'https://youtube.com/{username}',
                'name' => 'YouTube',
            ],
            [
                'icon' => 'fab fa-tiktok',
                'color' => '#000',
                'url' => 'https://tiktok.com/@{username}',
                'name' => 'TikTok',
            ],
            [
                'icon' => 'fab fa-whatsapp',
                'color' => '#25d366',
                'url' => 'https://wa.me/{phone}',
                'name' => 'WhatsApp',
            ],
            [
                'icon' => 'fab fa-telegram',
                'color' => '#0088cc',
                'url' => 'https://t.me/{username}',
                'name' => 'Telegram',
            ],
            [
                'icon' => 'fab fa-discord',
                'color' => '#5865f2',
                'url' => 'https://discord.gg/{username}',
                'name' => 'Discord',
            ],
            [
                'icon' => 'fab fa-slack',
                'color' => '#4a154b',
                'url' => 'https://slack.com/{username}',
                'name' => 'Slack',
            ],
            [
                'icon' => 'fab fa-skype',
                'color' => '#00aff0',
                'url' => 'https://join.skype.com/{username}',
                'name' => 'Skype',
            ],
            [
                'icon' => 'fab fa-pinterest',
                'color' => '#bd081c',
                'url' => 'https://pinterest.com/{username}',
                'name' => 'Pinterest',
            ],
            [
                'icon' => 'fab fa-snapchat',
                'color' => '#fffc00',
                'url' => 'https://snapchat.com/add/{username}',
                'name' => 'Snapchat',
            ],
            [
                'icon' => 'fab fa-twitch',
                'color' => '#6441a5',
                'url' => 'https://twitch.tv/{username}',
                'name' => 'Twitch',
            ],
            [
                'icon' => 'fab fa-spotify',
                'color' => '#1db954',
                'url' => 'https://open.spotify.com/user/{username}',
                'name' => 'Spotify',
            ],
            [
                'icon' => 'fab fa-soundcloud',
                'color' => '#ff5500',
                'url' => 'https://soundcloud.com/{username}',
                'name' => 'SoundCloud',
            ],
            [
                'icon' => 'fab fa-reddit',
                'color' => '#ff4500',
                'url' => 'https://reddit.com/user/{username}',
                'name' => 'Reddit',
            ],
            [
                'icon' => 'fab fa-medium',
                'color' => '#00ab6c',
                'url' => 'https://medium.com/@{username}',
                'name' => 'Medium',
            ],
            [
                'icon' => 'fab fa-patreon',
                'color' => '#f96854',
                'url' => 'https://patreon.com/{username}',
                'name' => 'Patreon',
            ],
            [
                'icon' => 'fas fa-globe',
                'color' => '#333',
                'url' => 'https://{domain}',
                'name' => 'Website',
            ],
        ]);

        $socials->each(function ($social) {
            \App\Models\SocialLink::create($social);
        });
    }
}
