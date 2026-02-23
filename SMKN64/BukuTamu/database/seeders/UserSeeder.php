<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Alvian',
                'email' => 'pian@arch.org',
                'password' => Hash::make('121212'),
                'role' => 'admin',
            ],
            [
                'name' => 'Kamel',
                'email' => 'kamel@arch.org',
                'password' => Hash::make('121212'),
                'role' => 'user',
            ],
        ]
        );
    }
}
