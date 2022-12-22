<?php

namespace Tests\Feature\Profile;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ChangePasswordTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    public function setUp() : void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }
    public function test_user_can_change_their_password()
    {
        $newPassword = 'new_password';

        $response = $this->actingAs($this->user)->patch(route('user.profile.update.password'), [
            'password' => 'password',
            'new_password' => $newPassword,
            'new_password_confirmation' => $newPassword,
        ]);

        $response->assertValid();
        $this->assertTrue(Hash::check($newPassword,$this->user->fresh()->password));
    }

    public function test_it_will_fire_the_password_reset_event()
    {
        Event::fake(PasswordReset::class);

        $newPassword = 'new_password';

        $response = $this->actingAs($this->user)->patch(route('user.profile.update.password'), [
            'password' => 'password',
            'new_password' => $newPassword,
            'new_password_confirmation' => $newPassword,
        ]);

        $response->assertValid();

        Event::assertDispatched(PasswordReset::class);
    }

    public function test_it_will_throw_a_validation_error_if_the_password_is_not_confirmed()
    {
        $newPassword = 'new_password';

        $response = $this->actingAs($this->user)->patch(route('user.profile.update.password'), [
            'password' => 'password',
            'new_password' => $newPassword,
        ]);

        $response->assertInvalid('new_password');
    }

    public function test_it_will_throw_a_validation_error_if_the_password_and_password_confirmation_is_not_the_same()
    {
        $newPassword = 'new_password';

        $response = $this->actingAs($this->user)->patch(route('user.profile.update.password'), [
            'password' => 'password',
            'new_password' => $newPassword,
            'new_password_confirmation' => 'not_the_same',
        ]);

        $response->assertInvalid('new_password');
    }

    public function test_it_will_throw_a_validation_error_if_the_current_password_is_not_correct()
    {
        $newPassword = 'new_password';

        $response = $this->actingAs($this->user)->patch(route('user.profile.update.password'), [
            'password' => 'not_correct_password',
            'new_password' => $newPassword,
            'new_password_confirmation' => $newPassword,
        ]);

        $response->assertInvalid('password');
    }
}
