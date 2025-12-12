<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert([
            [
                'title' => 'All Your Perfects',
                'writter' => 'Colleen Hoover',
                'publisher' => 'Atria Books',
                'pages' => 320,
                'category' => 1
            ],
            [
                'title' => 'The Viscount Who Loved Me',
                'writter' => 'Julia Quinn',
                'publisher' => 'Avon',
                'pages' => 376,
                'category' => 1
            ],
            [
                'title' => 'Trust',
                'writter' => 'Hernan Diaz',
                'publisher' => 'Riverhead Books',
                'pages' => 416,
                'category' => 2
            ],
            [
                'title' => 'The Wedding People',
                'writter' => 'Alison Espach',
                'publisher' => 'Henry Holt and Co',
                'pages' => 384,
                'category' => 2
            ],
            [
                'title' => 'Rich Dad Poor Dad',
                'writter' => 'Robert T. Kiyosaki & Sharon L. Lecther',
                'publisher' => 'Warner Books',
                'pages' => 336,
                'category' => 3
            ],
            [
                'title' => 'The Total Money Makeover',
                'writter' => 'Dave Ramsey',
                'publisher' => 'Thomas Nelson',
                'pages' => 272,
                'category' => 3
            ],
        ]);
    }
}
