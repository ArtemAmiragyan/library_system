<?php

namespace App\Http\Requests\Author;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuthor extends FormRequest
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
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'biography' => 'required|min:30',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First name is empty!',
            'first_name.max' => 'Too long first name!',
            'last_name.required' => 'last name is empty!',
            'last_name.max' => 'Too long last name!',
            'biography.required' => 'Biography is empty!',
            'biography.min' => 'Too short biography!',
        ];
    }
}
