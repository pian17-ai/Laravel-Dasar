<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tickets')->insert([
            [
                'event_id' => '1',
                'name' => 'Reguler',
                'price' => 0,
                'quota' => 40
            ],
            [
                'event_id' => '1',
                'name' => 'VIP',
                'price' => 120000,
                'quota' => 20
            ],
        ]);
    }
}
