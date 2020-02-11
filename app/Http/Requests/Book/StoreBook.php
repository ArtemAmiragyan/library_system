<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class StoreBook extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required|min:30',
            'author_id' => 'required|exists:authors,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is empty!',
            'title.max' => 'Too long title!',
            'description.required' => 'Description is empty!',
            'description.min' => 'Too short description!',
            'author_id.required' => 'Choose the author!',
            'author_id.exists' => 'There is no such author, you can create a new one!'
        ];
    }
}
