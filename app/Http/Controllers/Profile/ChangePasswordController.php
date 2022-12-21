<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ChangePasswordController extends Controller
{
    /**
     * Change the password of the user
     */
    public function __invoke(ChangePasswordRequest $request) : RedirectResponse
    {
        /**
         * @var \App\Models\User $user
         */
        $user = $request->user();

        $user->forceFill([
            'password' => Hash::make($request->input('new_password')),
        ])->setRememberToken(Str::random(60));
        
        $user->save();

        event(new PasswordReset($user));

        return back()->with([
            'status' => 'password-changed-successfully',
        ]);
    }
}
