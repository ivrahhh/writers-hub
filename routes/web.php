<?php

use App\Http\Controllers\Author\AuthorDashboardController;
use App\Http\Controllers\Books\UpdateBookTagsController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\Books\UserBookController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\Profile\ChangeEmailController;
use App\Http\Controllers\Profile\ChangePasswordController;
use App\Http\Controllers\Profile\UpdateAboutMeController;
use App\Http\Controllers\Profile\UserProfileController;
use App\Http\Controllers\View\DashboardController;
use App\Http\Middleware\EnsureUserIsAdmin;
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
    Route::middleware('role:member,author')->group(function() {
        Route::get('/', fn() => inertia('Home'))->name('home');
    });
    
    /**
     * Author Dashboard
     */
    Route::prefix('author')->group(function() {
        Route::get('/', AuthorDashboardController::class)->name('author.dashboard');
        Route::resource('books', UserBookController::class);
        Route::resource('books.chapters', ChapterController::class)->shallow();
        Route::put('book/{book}/tags', UpdateBookTagsController::class)->name('book.tags.update');
    });
    
    /**
     * User Profile Routes
     */
    Route::get('profile/{user:username}', UserProfileController::class)->name('user.profile');
    Route::put('profile/{user:username}/update/about-me', UpdateAboutMeController::class)->name('user.profile.update.about-me');    
    Route::patch('profile/password/change', ChangePasswordController::class)->name('user.profile.update.password');
    Route::patch('profile/email/change', ChangeEmailController::class)->name('user.profile.update.email');

    /**
     * Admin Routes
     */
    Route::middleware('role:admin')->group(function() {
        Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
        Route::resource('tags', TagController::class)->except('show');
        Route::resource('genres', GenreController::class)->except('show');
    });
});

require __DIR__.'/auth.php';