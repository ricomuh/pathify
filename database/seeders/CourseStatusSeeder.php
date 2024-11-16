<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // with colors
        $courseStatuses = collect([
            'Draft Not Published' => '#363636',
            'Need Approval' => '#FFA500',
            'Published' => '#008000',
            'Rejected' => '#FF0000',
            'Archived' => '#808080',
        ]);

        $courseStatuses->each(function ($color, $status) {
            \App\Models\CourseStatus::create([
                'name' => $status,
                'color' => $color,
            ]);
        });
    }
}
