<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UpdateBookTagsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Book $book)
    {
        $this->authorize('update', $book);

        $tags = $request->validate([
            'tags.*' => 'required',
        ]);
        try {
            $book->tags()->sync($request->input('tags'));

        } catch (\Exception $ex) {
            return back()->with([
                'error' => 'An error occured !'
            ]);
        }
    }
}
