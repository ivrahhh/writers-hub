<?php

namespace App\Http\Requests;

use App\Models\Book;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /**
         * @var \App\Models\User $user
         */
        $user = $this->user();

        return $user->can('create', Book::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:books,title',
            'synopsis' => 'required|min:100',
            'genres' => 'required',
            'tags' => 'required', 
        ];
    }

    public function validatedBookInfo() : array
    {
        return array_merge($this->safe()->only(['title','synopsis']), [
            'user_id' => Auth::id(),
        ]);
    }

    public function genres() : array
    {
        return $this->validated('genres')->toArray();
    }

    public function tags() : array
    {
        return $this->validated('tags')->toArray();
    }
}
