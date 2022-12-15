<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'username' => 'xenocidee',
            'email' => 'harvicapino22@gmail.com',
            'remember_token' => null,
            'role' => 'Admin'
        ]);

        $this->call([TagSeeder::class, GenreSeeder::class]);
    }
}
