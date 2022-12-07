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
            ['genre' => 'Harem', 'description' => fake()->unique()->realText()],
            ['genre' => 'Romance', 'description' => fake()->unique()->realText()],
            ['genre' => 'Fantasy', 'description' => fake()->unique()->realText()],
            ['genre' => 'Action', 'description' => fake()->unique()->realText()],
            ['genre' => 'School Life', 'description' => fake()->unique()->realText()],
            ['genre' => 'Adventure', 'description' => fake()->unique()->realText()],
            ['genre' => 'Comedy', 'description' => fake()->unique()->realText()],
            ['genre' => 'Ecchi', 'description' => fake()->unique()->realText()],
            ['genre' => 'Horror', 'description' => fake()->unique()->realText()],
            ['genre' => 'Drama', 'description' => fake()->unique()->realText()],
        ]);
    }
}
