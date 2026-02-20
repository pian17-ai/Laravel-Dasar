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
            'full_name' => 'Alvian Cahyo Pambudi',
            "email" => 'pian@arch.org',
            'password' => Hash::make("121212"),
            'birth_date' => '2009-04-17',
            'role_id' => 1
        ]);
    }
}
