<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genre::query()->insert([
            ['genre' => 'Harem'],
            ['genre' => 'Romance'],
            ['genre' => 'Fantasy'],
            ['genre' => 'Action'],
            ['genre' => 'School Life'],
            ['genre' => 'Adventure'],
            ['genre' => 'Comedy'],
            ['genre' => 'Ecchi'],
            ['genre' => 'Horror'],
            ['genre' => 'Drama'],
        ]);
    }
}
