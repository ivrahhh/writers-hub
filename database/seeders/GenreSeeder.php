<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            ['id' => Str::orderedUuid(),'genre' => 'Harem', 'description' => fake()->unique()->realText()],
            ['id' => Str::orderedUuid(),'genre' => 'Romance', 'description' => fake()->unique()->realText()],
            ['id' => Str::orderedUuid(),'genre' => 'Fantasy', 'description' => fake()->unique()->realText()],
            ['id' => Str::orderedUuid(),'genre' => 'Action', 'description' => fake()->unique()->realText()],
            ['id' => Str::orderedUuid(),'genre' => 'School Life', 'description' => fake()->unique()->realText()],
            ['id' => Str::orderedUuid(),'genre' => 'Adventure', 'description' => fake()->unique()->realText()],
            ['id' => Str::orderedUuid(),'genre' => 'Comedy', 'description' => fake()->unique()->realText()],
            ['id' => Str::orderedUuid(),'genre' => 'Ecchi', 'description' => fake()->unique()->realText()],
            ['id' => Str::orderedUuid(),'genre' => 'Horror', 'description' => fake()->unique()->realText()],
            ['id' => Str::orderedUuid(),'genre' => 'Drama', 'description' => fake()->unique()->realText()],
        ]);
        
    }
}
