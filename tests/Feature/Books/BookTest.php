<?php

namespace Tests\Feature\Books;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected User $admin;

    public function setUp() : void
    {
        parent::setUp();

        $this->seed();

        $this->user = User::factory()->create();
        $this->admin = User::factory()->create([
            'role' => 'Admin',
        ]);
    }

    public function test_user_can_create_new_book()
    {
        $bookData = [
            'title' => 'The New Book',
            'synopsis' => fake()->realText(),
            'tags' => Tag::all()->pluck('id')->random(5)->toArray(),
            'genres' => Genre::all()->pluck('id')->random(3)->toArray(),
        ];

        $response = $this->actingAs($this->user)->post(route('books.store'), $bookData);

        $response->assertValid();

        $this->assertDatabaseHas('books', [
            'title' => $bookData['title'],
            'synopsis' => $bookData['synopsis'],
        ]);

        
        $response->assertSessionHas('status', 'book-has-been-created');   
    }

    public function test_user_cannot_use_already_user_title_for_their_book()
    {
        $book = Book::factory()->create();

        $response = $this->actingAs($this->user)->post(route('books.store'), [
            'title' => $book->title,
            'synopsis' => fake()->realText(),
            'genres' => Genre::all()->pluck('id')->random(3),
            'tags' => Tag::all()->pluck('id')->random(5),
        ]);

        $response->assertInvalid('title');
    }

    public function test_admin_cannot_create_a_book()
    {
        $bookData = [
            'title' => 'The New Book',
            'synopsis' => fake()->realText(),
            'tags' => Tag::all()->pluck('id')->random(5)->toArray(),
            'genres' => Genre::all()->pluck('id')->random(3)->toArray(),
        ];

        $response = $this->actingAs($this->admin)->post(route('books.store'), $bookData);

        $response->assertStatus(403);
    }

    public function test_user_can_update_their_book()
    {
        $book = Book::factory()->for($this->user)
            ->hasAttached(Genre::factory()->count(3))
            ->hasAttached(Tag::factory()->count(5))
            ->create();

        $book->load(['genres','tags']);

        $response = $this->actingAs($this->user)->put(route('books.update', $book->id), [
            'title' => $book->title,
            'synopsis' => 'Updated Description',
            'tags' => $book->tags->pluck('id')->toArray(),
            'genres' => $book->genres->pluck('id')->toArray(),           
        ]);

        $response->assertValid();

        $this->assertTrue($book->fresh()->synopsis === 'Updated Description');
    }

    public function test_user_cannot_change_the_title_of_their_book_to_the_already_existing_title()
    {
        $book = Book::factory()->for($this->user)
        ->hasAttached(Genre::factory()->count(3))
        ->hasAttached(Tag::factory()->count(5))
        ->create();

        $book->load(['genres','tags']);

        $alreadyExistingBook = Book::factory()->create();

        $response = $this->actingAs($this->user)->put(route('books.update', $book->id), [
            'title' => $alreadyExistingBook->title,
            'synopsis' => 'Updated Description',
            'tags' => $book->tags->pluck('id')->toArray(),
            'genres' => $book->genres->pluck('id')->toArray(),     
        ]);

        $response->assertInvalid();
    }

    public function test_admin_cannot_update_the_book_information()
    {
        $book = Book::factory()->for($this->user)
        ->hasAttached(Genre::factory()->count(3))
        ->hasAttached(Tag::factory()->count(5))
        ->create();

        $book->load(['genres','tags']);

        $response = $this->actingAs($this->admin)->put(route('books.update', $book->id), [
            'title' => $book->title,
            'synopsis' => 'Updated Description',
            'tags' => $book->tags->pluck('id')->toArray(),
            'genres' => $book->genres->pluck('id')->toArray(),     
        ]);

        $response->assertStatus(403);
    }
    
    public function test_user_cannot_update_the_book_they_dont_own()
    {
        $book = Book::factory()
            ->hasAttached(Genre::factory()->count(3))
            ->hasAttached(Tag::factory()->count(5))
            ->create();

        $book->load(['genres','tags']);

        $response = $this->actingAs($this->user)->put(route('books.update', $book->id), [
            'title' => $book->title,
            'synopsis' => 'Updated Description',
            'tags' => $book->tags->pluck('id')->toArray(),
            'genres' => $book->genres->pluck('id')->toArray(),     
        ]);

        $response->assertStatus(403);
    }

    public function test_user_can_delete_their_own_book()
    {
        $book = Book::factory()->for($this->user)->create();

        $response = $this->actingAs($this->user)->delete(route('books.destroy', $book->id));
        $this->assertModelMissing($book);
    }

    public function test_other_user_cannot_delete_book_they_do_not_own()
    {
        $book = Book::factory()->create();

        $response = $this->actingAs($this->user)->delete(route('books.destroy', $book->id));
        $response->assertStatus(403);
    }
}
