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
            'title' => 'Genshin Cosplay Festival',
            'location' => 'Kalibata City Square, South Jakarta',
            'event_date' => now(),
            'price' => 0,
            'created_by' => 1
        ]);
    }
}
