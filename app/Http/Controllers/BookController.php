<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Inertia\Response;

class BookController extends Controller
{
    public function index() : Response
    {
        return inertia('Books/BookList', [
            'books' => Book::query()->paginate(10),
        ]);
    }

    public function create() : Response
    {
        return inertia('Books/CreateNewBook');
    }

    public function store(CreateBookRequest $request) : RedirectResponse
    {
        DB::beginTransaction();
        
        $book = Book::query()->create(
            Arr::except($request->validated(), ['genres','tags'])
        );
        
        $book->genres()->attach($request->validated('genres'));
        $book->tags()->attach($request->validated('tags'));
    
        return back()->with([
            'status' => 'book-has-been-created',
        ]);
    }
}
