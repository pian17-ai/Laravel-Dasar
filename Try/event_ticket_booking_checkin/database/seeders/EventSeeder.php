<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Symfony\Component\Clock\now;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->insert([
            'title' => 'GDG Jakarta 2025',
            'location' => 'MH Tamrin, Central Jakarta',
            'event_date' => now(),
            'created_by' => 2
        ]);
    }
}
