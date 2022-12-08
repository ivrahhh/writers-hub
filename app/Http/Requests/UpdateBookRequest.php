<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => [
                'required',
                Rule::unique('books','title')->ignore($this->book),
            ],

            'synopsis' => 'required|min:8',
            'tags' => 'required',
            'genres' => 'required',
        ];
    }

    public function validatedBookInfo() : array
    {
        return $this->safe()->only(['title','synopsis']);
    }

    public function genres() : array
    {
        return $this->validated('genres');
    }

    public function tags() : array
    {
        return $this->validated('tags');
    }
}
