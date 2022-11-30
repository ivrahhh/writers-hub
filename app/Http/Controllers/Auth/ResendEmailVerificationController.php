<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ResendEmailVerificationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request) : RedirectResponse
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with([
            'status' => 'verification-link-sent',
        ]);
    }
}
