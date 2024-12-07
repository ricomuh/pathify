<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Category;
use App\Models\QuestionnaireResult;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionnaireResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $categories = Category::whereNull('parent_id')->get();
        $users = User::where('role_id', RoleEnum::User)->get();

        $users->each(function ($user) {
            QuestionnaireResult::factory()->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
