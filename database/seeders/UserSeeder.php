<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // make admin
        User::factory()->create([
            // 'name' => 'Admin',
            'email' => 'admin@example.com',
            'role_id' => RoleEnum::Admin,
        ]);

        // make mentor
        User::factory()->create([
            // 'name' => 'Mentor',
            'email' => 'mentor@example.com',
            'role_id' => RoleEnum::Mentor,
        ]);

        // make user
        User::factory()->create([
            // 'name' => 'User',
            'email' => 'user@example.com',
            'role_id' => RoleEnum::User,
        ]);
    }
}
