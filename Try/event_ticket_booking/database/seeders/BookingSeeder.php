<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Symfony\Component\Clock\now;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bookings')->insert([
            [
                'user_id' => 3,
                'event_id' => 1,
                'booked_at' => now()
            ],
            [
                'user_id' => 4,
                'event_id' => 2,
                'booked_at' => now()
            ],
        ]);
    }
}
