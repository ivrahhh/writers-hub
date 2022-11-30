<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules() : array
    {
        return [
            'email' => ['required', 'email','unique:users,email'],
            'password' => ['required','min:8','confirmed'],
        ];
    }

    /**
     * Get the validated data with already hashed password.
     */
    public function validatedWithHashedPassword() : array
    {
        return array_merge($this->validated(), [
            'password' => Hash::make($this->input('password')),
        ]);
    }
}
