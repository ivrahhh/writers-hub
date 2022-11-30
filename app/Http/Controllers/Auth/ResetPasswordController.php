<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Inertia\Response;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function edit(Request $request) : Response
    {
        return inertia('Auth/ResetPassword', [
            'token' => $request->token,
            'email' => $request->email,
            'status' => session('status')
        ]);
    }

    public function update(Request $request) : RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset($credentials, function(User $user, $password) {
            $user->forceFill([
                'password' => Hash::make($password),
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        });

        if($status === Password::PASSWORD_RESET) {
            return redirect()
                ->route('login')
                ->with(['status' => 'password-reset-successfully']);
        }

        if($status === Password::INVALID_USER) {
            return back()->withErrors([
                'email' => __($status),
            ]);
        }

        return back()->with([
            'status' => 'invalid-token',
        ]);
    }
}
