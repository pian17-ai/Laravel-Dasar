<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
            [
                'title' => 'GDG Jakarta 2025',
                'location' => 'Mh Tamrin, Central Jakarta',
                'event_date' => Carbon::now()->addDays(42),
                'price' => 0,
                'created_by' => 1
            ],
        ]);
    }
}
