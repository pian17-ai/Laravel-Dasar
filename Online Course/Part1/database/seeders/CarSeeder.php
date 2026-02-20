<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cars')->insert([
            [
                'name' => 'Porsche 911 GT3RS',
                'brand' => 'Porsche',
                'type' => 'Super Car',
                'year' => '2024',
                'price' => 1200000000
            ],
            [
                'name' => 'BMW M4 Competiton',
                'brand' => 'BMW',
                'type' => 'Super Car',
                'year' => '2024',
                'price' => 1200000000
            ],
            [
                'name' => 'BMW F30',
                'brand' => 'BMW',
                'type' => 'Sport Car',
                'year' => '2024',
                'price' => 800000000
            ]
        ]);
    }
}
