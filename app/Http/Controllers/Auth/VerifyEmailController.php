<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class VerifyEmailController extends Controller
{
    public function index(Request $request) : Response
    {
        if($request->user()->hasVerifiedEmail()) {
            return redirect('/');
        }

        return inertia('Auth/EmailVerify', [
            'status' => session('status'),
        ]);
    }

    public function store(EmailVerificationRequest $request) : RedirectResponse
    {
        if(! $request->user()->hasVerifiedEmail()) {
            $request->fulfill();
        }
        
        return redirect('/');
    }
}
