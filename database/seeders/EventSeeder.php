<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Event;
use App\Models\User;
use App\Models\UserEvent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role_id', RoleEnum::User)->get();

        $this->command->info('Making events...');
        Event::factory(10)->create()->each(function ($event) use ($users) {
            $users->random(rand(1, 8))->each(function ($user) use ($event) {
                UserEvent::create([
                    'user_id' => $user->id,
                    'event_id' => $event->id,
                ]);
            });
        });
    }
}
