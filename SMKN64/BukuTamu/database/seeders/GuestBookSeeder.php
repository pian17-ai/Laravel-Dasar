<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Symfony\Component\Clock\now;

class GuestBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('guest_books')->insert(
            [
                'user_id' => 1,
                'message' => 'woi ini admin',
                'image' => null,
                'is_approved' => true,
                'is_pinned' => true,
                'created_at' => now()
            ],
            [
                'user_id' => 2,
                'message' => 'makanan tamu sangat enak',
                'image' => null,
                'is_approved' => true,
                'is_pinned' => true,
                'created_at' => now()
            ],
        );
    }
}
