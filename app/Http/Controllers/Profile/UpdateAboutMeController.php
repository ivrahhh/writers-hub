<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UpdateAboutMeController extends Controller
{
    public function __invoke(Request $request, User $user) : RedirectResponse
    {
        $aboutMe = $request->validate([
            'about_me' => "required|max:500",
        ]);

        $user->update($aboutMe);

        return back();
    }
}
