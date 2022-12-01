<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::query()->insert([
            ['tag' => 'Harem Seeking Protagonist', 'created_at' => now(), 'updated_at' => now()],
            ['tag' => 'Male Protagonist', 'created_at' => now(), 'updated_at' => now()],
            ['tag' => 'Female Protagonist', 'created_at' => now(), 'updated_at' => now()],
            ['tag' => 'Weak to Strong', 'created_at' => now(), 'updated_at' => now()],
            ['tag' => 'Strong to Stronger', 'created_at' => now(), 'updated_at' => now()],
            ['tag' => 'Academy', 'created_at' => now(), 'updated_at' => now()],
            ['tag' => 'Transmigation', 'created_at' => now(), 'updated_at' => now()],
            ['tag' => 'Isekai', 'created_at' => now(), 'updated_at' => now()],
            ['tag' => 'R-18', 'created_at' => now(), 'updated_at' => now()],
            ['tag' => 'R-16', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
