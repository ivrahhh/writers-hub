<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Tag;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Response;

class UserBookController extends Controller
{
    public function index() : Response
    {
        $books = Book::query()
                    ->where('user_id', Auth::id())
                    ->with('image:imageable_id,url')
                    ->paginate(5);

        return inertia('Author/BookList', compact('books'));
    }

    public function create() : Response
    {
        return inertia('Author/CreateBook', [
            'tags'=> Tag::all(),
            'genres' => Genre::all(),
        ]);
    }

    public function store(CreateBookRequest $request) : RedirectResponse
    {
        try {
            DB::beginTransaction();

            $book = Book::query()->create(
                $request->validatedBookInfo(),
            );

            Auth::user()->update([
                'role' => 'Author',
            ]);

            $book->image()->create([
                'url' => fake()->imageUrl(word: $book->title),
            ]);

            $book->genres()->attach($request->genres());
            $book->tags()->attach($request->tags());

            DB::commit();

        } catch (Exception $ex) {
            DB::rollBack();
            return back()->with([
                'status' => $ex->getMessage(),
            ]);
        }
        
        return redirect()->route('books.index')->with([
            'status' => 'book-has-been-created',
        ]);
    }

    public function edit(Book $book) : Response
    {
        $book->load(['tags','genres','author']);

        return inertia('Book/ShowBook', compact('book'));
    }

    public function update(Book $book, UpdateBookRequest $request) : RedirectResponse
    {
        try {

            DB::beginTransaction();

            tap($book)->update(
                $request->validatedBookInfo()
            );

            $book->tags()->sync($request->tags());
            $book->genres()->sync($request->genres());

            DB::commit();
            
        } catch (Exception $ex) {
            DB::rollBack();

            return back()->with([
                'status' => $ex->getMessage(),
            ]);
        }

        return back()->with([
            'status' => 'book-info-has-been-updated',
        ]);
    }

    public function destroy(Book $book) : RedirectResponse
    {
        $this->authorize('delete', $book);

        $book->delete();

        return back()->with([
            'status' => 'book-has-been-deleted',
        ]);
    }
}
