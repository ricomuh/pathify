<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\MentorDetail;
use App\Models\Role;
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
        // make roles
        $roles = collect([
            'Admin',
            'Mentor',
            'User'
        ]);

        $roles->each(function ($role) {
            Role::create([
                'name' => $role,
            ]);
        });


        // make admin
        User::factory()->create([
            // 'name' => 'Admin',
            'email' => 'admin@example.com',
            'role_id' => RoleEnum::Admin,
        ]);

        // make mentors
        User::factory(3)->create([
            // 'name' => 'Mentor',
            'role_id' => RoleEnum::Mentor,
        ])->each(function ($mentor) {
            MentorDetail::factory()->create([
                'user_id' => $mentor->id,
            ]);
        });

        // make users
        User::factory(50)->create([
            // 'name' => 'User',
            'role_id' => RoleEnum::User,
        ]);
    }
}
