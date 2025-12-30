<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'name' => 'admin',
                'email' => 'admin1@example.com',
                'password' => Hash::make(123456),
                'role' => 'admin',
            ],
            [
                'name' => 'admin2',
                'email' => 'admin2@example.com',
                'password' => Hash::make(123456),
                'role' => 'admin',
            ],
            [
                'name' => 'officer1',
                'email' => 'officer1@example.com',
                'password' => Hash::make(123456),
                'role' => 'officer',
            ],
            [
                'name' => 'officer2',
                'email' => 'officer2@example.com',
                'password' => Hash::make(123456),
                'role' => 'officer',
            ],
            [
                'name' => 'pian',
                'email' => 'pian@example.com',
                'password' => Hash::make(123456),
                'role' => 'user',
            ],
            [
                'name' => 'ebina',
                'email' => 'ebina@example.com',
                'password' => Hash::make(123456),
                'role' => 'user',
            ]
        ]);
    }
}
