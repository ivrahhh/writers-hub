<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;

class UserAuthenticationController extends Controller
{
    /**
     * Render the login form
     */
    public function create() : Response
    {
        return inertia('Auth/Login', [
            'status' => session('status'),
        ]);
    }

    /**
     * Start a new authenticated session
     */
    public function store(LoginRequest $request) : RedirectResponse
    {
        $request->authenticate();
    
        /**
         * @var \App\Models\User $user
         */
        $user = Auth::user();
        
        if($user->isAdmin()) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('home');
    }

    /**
     * Destroy the current authentication session
     */
    public function destroy(Request $request) : RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
