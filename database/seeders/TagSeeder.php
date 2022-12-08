<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            ['id' => Str::orderedUuid(),'tag' => 'Harem Seeking Protagonist', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::orderedUuid(),'tag' => 'Male Protagonist', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::orderedUuid(),'tag' => 'Female Protagonist', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::orderedUuid(),'tag' => 'Weak to Strong', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::orderedUuid(),'tag' => 'Strong to Stronger', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::orderedUuid(),'tag' => 'Academy', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::orderedUuid(),'tag' => 'Transmigation', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::orderedUuid(),'tag' => 'Isekai', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::orderedUuid(),'tag' => 'R-18', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::orderedUuid(),'tag' => 'R-16', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
