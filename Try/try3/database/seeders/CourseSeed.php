<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            'title' => 'Laravel 12 Course',
            'description' => 'Learning Laravel 12 with Pian',
            'price' => 200000,
            'created_by' => 1
        ]);
    }
}
