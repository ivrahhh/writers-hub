<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;

class UserRegistrationController extends Controller
{
    public function __construct(
        public UserRepository $repository
    ) {
    }

    public function create() : Response
    {
        return inertia('Auth/Register');
    }

    /**
     * Store the new user to the database.
     */
    public function store(RegisterUserRequest $request) : RedirectResponse
    {
        $user = $this->repository->create(
            $request->validatedWithHashedPassword()
        );

        Auth::login($user);

        return redirect('/');
    }
}
