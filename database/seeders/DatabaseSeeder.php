<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use App\Models\Chapter;
use App\Models\Image;
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

        $user = User::factory()->create([
            'username' => 'harvicapino22',
            'email' => 'harvincent.parientes.capino@gmail.com',
            'remember_token' => null,
        ]);
        
        $author = User::factory()->create([
            'username' => 'chichi',
            'email' => 'sample@email.com',
            'role' => 'Author',
        ]);

        Book::factory(20)->for($author)->has(Image::factory()->count(1))->create();

        $book = Book::factory()->for($user)->has(Chapter::factory()->count(30))->create();
        Image::factory()->for($book, 'imageable')->create(); 
        Image::factory()->for($user, 'imageable')->create();

        $this->call([TagSeeder::class, GenreSeeder::class]);
    }
}
