<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            [
                'title' => 'Laravel 12 Course',
                'description' => 'Laravel course by pian, have 5 videos for beginner',
                'price' => 150000,
                'created_by' => 1
            ],
            [
                'title' => 'ReactJs Course',
                'description' => 'React course with Typescript',
                'price' => 200000,
                'created_by' => 1
            ],
        ]);
    }
}
