<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Inertia\Response;

class ForgotPasswordController extends Controller
{
    public function create() : Response
    {
        return inertia('Auth/ForgotPassword', [
            'status' => session('status'),
        ]);
    }

    public function store(Request $request) : RedirectResponse
    {
        $email = $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink($email);

        if($status === Password::RESET_LINK_SENT) {
            return back()->with([
                'status' => 'password-reset-request-sent'
            ]);
        }

        return back()->withErrors([
            'email' => __($status),
        ]);
    }
}
