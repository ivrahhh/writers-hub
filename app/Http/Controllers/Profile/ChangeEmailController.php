<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeEmailRequest;
use Illuminate\Http\RedirectResponse;

class ChangeEmailController extends Controller
{
    /**
     * Change the email address of the user
     */
    public function __invoke(ChangeEmailRequest $request) : RedirectResponse
    {
        /**
         * @var \App\Models\User $user
         */
        $user = $request->user();
        
        try {

            $user->forceFill([
                'email' => $request->input('email'),
                'email_verified_at' => null,
            ]);
            
            $user->save();

            $user->sendEmailVerificationNotification();

            return back()->with([
                'status' => 'email-change-successfully',
            ]);

        } catch(\Exception $ex) {
            return back()->withErrors([
                'email' => 'An error occured',
            ]);
        }        
    }
}
