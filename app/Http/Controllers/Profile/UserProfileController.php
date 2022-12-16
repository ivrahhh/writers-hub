<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function __invoke(User $user)
    {
        $user->load('image:imageable_id,url');

        return inertia('Profile/User', [
            'user' => $user,
            'books' => $user->books()->get(),
        ]);
    }
}
