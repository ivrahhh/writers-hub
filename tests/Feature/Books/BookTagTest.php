<?php

namespace Tests\Feature\Books;

use App\Models\Book;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class BookTagTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp() : void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_user_can_add_new_tag_to_their_book()
    {
        $user = User::factory()->create();
        $tags = Arr::flatten(Tag::query()->get('id')->random(5)->toArray());
        $book = Book::factory()
            ->for($user)
            ->create();
        
        $response = $this->actingAs($user)->put(route('book.tags.update', $book->id), [
            'tags' => $tags,
        ]);

        $response->assertValid();

        $book->load('tags');
        $this->assertNotNull($book->tags->first());
    }
}
