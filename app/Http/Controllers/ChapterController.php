<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChapterRequest;
use App\Http\Requests\CreateChapterRequest;
use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function index(Request $request) : View
    {
        $chapters = Chapter::query()
            ->where('book_id', $request->book)
            ->latest()
            ->paginate(10);
        
        return view('Books/Chapters', compact('chapters'));
    }

    public function store(ChapterRequest $request, Book $book) : RedirectResponse
    {
        $chapter = $book->chapters()->create($request->validated());

        return back()->with([
            'status' => 'new-chapter-added',
        ]);
    }

    public function update(ChapterRequest $request, Chapter $chapter) : RedirectResponse
    {
        dd($request->validated());
        $chapter->update($request->validated());

        return back()->with([
            'status' => 'chapter-has-been-updated',
        ]);
    } 
}
