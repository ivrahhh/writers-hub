<?php

use App\Http\Controllers\Books\UpdateBookTagsController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\Books\UserBookController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\View\DashboardController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['verified','auth'])->group(function() {
    Route::get('/', function () {
        return inertia('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    });

    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::resource('tags', TagController::class)->except('show');
    Route::resource('genres', GenreController::class)->except('show');
    Route::resource('books', UserBookController::class);
    Route::resource('books.chapters', ChapterController::class)->shallow();

    Route::put('book/{book}/tags', UpdateBookTagsController::class)->name('book.tags.update');
});

require __DIR__.'/auth.php';