<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Response;

class UserBookController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Book::class, 'book');
    }
    public function index() : Response
    {
        $books = Book::query()
                    ->where('user_id', Auth::id())
                    ->paginate(10);

        return inertia('Books/BookList', compact('books'));
    }

    public function create() : Response
    {
        return inertia('Books/CreateNewBook');
    }

    public function store(CreateBookRequest $request) : RedirectResponse
    {
        try {
            DB::beginTransaction();
            
            $book = Book::query()->create(
                $request->validatedBookInfo(),
            );
            
            $book->genres()->attach($request->genres());
            $book->tags()->attach($request->tags());

        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
            return back()->with([
                'status' => $ex->getMessage(),
            ]);
        }
        
        return back()->with([
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
