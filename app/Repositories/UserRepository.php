<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Auth\Events\Registered;

class UserRepository
{
    /**
     * Create the a new user.
     */
    public function create(array $data) : User
    {
        $user = User::query()->create($data + [
            'username' => fake()->userName(), // random default username that can be change by user.
        ]);

        //Execute the event when user is registered
        event(new Registered($user));

        return $user;
    }
}