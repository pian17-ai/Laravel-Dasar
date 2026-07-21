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
            'title' => 'Latern Rite GI Indonesia',
            'start_time' => now(),
            'end_time' => now(),
            'created_by' => 1,
            'is_active' => true
        ]);
    }
}
