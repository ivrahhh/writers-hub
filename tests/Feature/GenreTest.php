<?php

namespace Tests\Feature;

use App\Models\Genre;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GenreTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected User $admin;

    public function setUp() : void
    {
        parent::setUp();

        $this->seed();

        $this->admin = User::factory()->create(['role' => 'Admin']);
        $this->user = User::factory()->create();
    }

    public function test_admin_can_add_new_genre()
    {
        $genre = [
            'genre' => 'New Genre',
            'description' => fake()->realText(),
        ];

        $response = $this->actingAs($this->admin)->post(route('genres.store'), $genre);

        $response->assertValid();
        $this->assertDatabaseHas('genres', $genre);
    }

    public function test_user_cannot_add_new_genre()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($this->user)->post(route('genres.store'), [
            'genre' => fake()->word(),
            'description' => fake()->realText(),
        ]);

        $response->assertStatus(403);
    }

    public function test_admin_cannot_add_duplicated_genre()
    {
        $admin = User::factory()->create([
            'role' => 'Admin',
        ]);

        $response = $this->actingAs($this->admin)->post(route('genres.store'), [
            'genre' => 'Adventure',
            'description' => fake()->realText(),
        ]);

        $response->assertInvalid('genre');
    }

    public function test_admin_can_update_existing_genre()
    {
        $genre = Genre::first();
        
        $genreUpdate = [
            'genre' => $genre->genre,
            'description' => 'This is a new Genre Description',
        ];
        
        $response = $this->actingAs($this->admin)->put(route('genres.update', $genre->id), $genreUpdate);
        
        $response->assertValid();
    
        $this->assertTrue($genre->fresh()->description === $genreUpdate['description']);
    }

    public function test_admin_cannot_update_exisitng_genre_with_already_exsisting_genre()
    {
        $genre = Genre::query()->first();

        $genreUpdate = [
            'genre' => 'Comedy',
            'description' => $genre->description,
        ];

        $response =  $this->actingAs($this->admin)->put(route('genres.update', $genre->id), $genreUpdate);
        
        $response->assertInvalid('genre');
    }

    public function test_user_cannot_update_existing_genre()
    {
        $genre = Genre::query()->first();

        $response = $this->actingAs($this->user)->put(route('genres.update', $genre->id), [
            'genre' => $genre->genre,
            'description' => fake()->realText(),
        ]);

        $response->assertStatus(403);
    }

    public function test_admin_can_delete_exsiting_genre()
    {
        $genre = Genre::query()->first();

        $response = $this->actingAs($this->admin)->delete(route('genres.destroy', $genre->id));
        
        $this->assertDatabaseMissing('genres', $genre->toArray());
    }

    public function test_user_cannot_delete_exsiting_genre()
    {
        $genre = Genre::query()->first();

        $response = $this->actingAs($this->user)->delete(route('genres.destroy', $genre->id));

        $response->assertStatus(403);
    }
}
