<?php

namespace Tests\Feature\Profile;

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ChangeEmailTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    public function setUp() : void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_user_can_change_their_email_address()
    {
        $email = 'newemail@email.com';

        $response = $this->actingAs($this->user)->patch(route('user.profile.update.email'), [
            'old_email' => $this->user->email,
            'email' => $email,
        ]);

        $response->assertValid();

        $user = $this->user->fresh();

        $this->assertFalse($user->hasVerifiedEmail());
        $this->assertTrue($user->email === $email);
    }

    public function test_verification_link_will_be_send_after_changing_the_email()
    {
        Notification::fake(VerifyEmail::class);

        $email = 'newemail@email.com';

        $response = $this->actingAs($this->user)->patch(route('user.profile.update.email'), [
            'old_email' => $this->user->email,
            'email' => $email,
        ]);

        $response->assertValid();

        Notification::assertSentTo($this->user, VerifyEmail::class);
    }

    public function test_it_will_throw_a_validation_error_if_the_new_email_is_already_been_used()
    {
        $user = User::factory()->create();

        $email = $user->email;

        $response = $this->actingAs($this->user)->patch(route('user.profile.update.email'), [
            'old_email' => $this->user->email,
            'email' => $email,
        ]);

        $response->assertInvalid('email');
    }

    public function tesst_it_will_throw_a_validation_error_if_the_email_is_invalid()
    {
        $email = 'invalidEMail';

        $response = $this->actingAs($this->user)->patch(route('user.profile.update.email'), [
            'old_email' => $this->user->email,
            'email' => $email,
        ]);

        $response->assertInvalid('email');
    }
}
