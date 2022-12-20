<?php

namespace Tests\Unit\Repositories;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;
    
    public function testCanCreateNewUser()
    {
        $userRepository = new UserRepository;

        $user = $userRepository->create([
            'email' => fake()->email,
            'password' => Hash::make('password'),
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $user->email, 
        ]);
    }

    public function testItWillReturnAUserModel()
    {
        $userRepository = new UserRepository;

        $user = $userRepository->create([
            'email' => fake()->email(),
            'password' => Hash::make('password'),
        ]);

        $this->assertTrue($user instanceof User);
    }

    public function testItWillThrowQueryExceptionIfEmailIsAlreadyUsed()
    {
        $hell = User::factory()->create();

        $this->assertThrows(function() use ($hell) {
            $userRepository = new UserRepository;
            $userRepository->create(['email' => $hell->email, 'password' => Hash::make('password')]);
        }, QueryException::class);
    }
}
