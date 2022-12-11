<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChapterRequest extends FormRequest
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

        if(! is_null($this->book)) {
            return $user->can('update', $this->book);
        }
        
        return $this->chapter->book->user->is($this->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'chapter_title' => 'required|max:75',
            'content' => 'required',
        ];
    }
}
