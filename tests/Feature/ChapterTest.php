<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Chapter;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChapterTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected User $admin;

    protected Book $book;

    public function setUp() : void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->admin = User::factory()->create([
            'role' => 'Admin',
        ]);
        $this->book = Book::factory()->for($this->user)->create();
    }

    public function test_user_can_add_new_chapter_to_the_book_they_own()
    {
        
        $chapterData = [
            'chapter_title' => 'A New Chapter',
            'content' => fake()->realText(500),
        ];

        $response = $this->actingAs($this->user)->post(route('books.chapters.store' , $this->book->id), $chapterData);
        $response->assertValid();

        $this->assertDatabaseHas('chapters', $chapterData);
    }

    public function test_admin_cannot_add_new_chapter_to_any_book()
    {
        $chapterData = [
            'chapter_title' => 'A New Chapter',
            'content' => fake()->realText(500),
        ];

        $response = $this->actingAs($this->admin)->post(route('books.chapters.store', $this->book->id), $chapterData);

        $response->assertStatus(403);
    }

    public function test_user_can_update_exsiting_chapter()
    {
        $chapter = Chapter::factory()->for($this->book)->create();

        $response = $this->actingAs($this->user)->put(route('chapters.update', $chapter->id), [
            'chapter_title' => 'New chpater',
            'content' => $chapter->content,
        ]);

        $response->assertValid();

        
    }
}
