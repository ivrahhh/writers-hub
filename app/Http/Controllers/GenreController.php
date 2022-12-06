<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Response;

class GenreController extends Controller
{
    public function index() : Response
    {
        return inertia('Genres/GenreList', [
            'genre' => Genre::query()->paginate(10),
            'status' => session('status'),
        ]);
    }

    public function create() : Response
    {
        return inertia('Genres/GenreForm', [
            'status' => session('status'),
            'route' => route('genres.store'),
        ]);
    }

    public function store(Request $request) : RedirectResponse
    {
        $genre = $request->validate([
            'genre' => 'required|unique:genres',
        ]);

        Genre::query()->create($genre);

        return back()->with([
            'status' => 'genre-has-been-added',
        ]);
    }

    public function edit(Genre $genre) : Response
    {
        return inertia('Genres/GenreForm', [
            'genre' => $genre,
            'route' => route('genres.update'),
        ]);
    }

    public function update(Genre $genre, Request $request) : RedirectResponse
    {
        $validated = $request->validate([
            'genre' => [
                'required',
                Rule::unique('genres', 'genre')->ignore($genre),
            ],
            'description' => 'required',
        ]);

        $genre->update($validated);

        return back()->with([
            'status' => 'genre-has-been-updated',
        ]);
    }

    public function destroy(Genre $genre) : RedirectResponse
    {
        $genre->delete();

        return back()->with([
            'status' => 'genre-has-been-delete',
        ]);
    }
}
