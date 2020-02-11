<?php

namespace App\Http\Requests\Reviews;

use Illuminate\Foundation\Http\FormRequest;

class ReviewStore extends FormRequest
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
            'body' => 'required|min:10',
            'assessment' => 'required|integer|between:1,5'
        ];
    }

    public function messages()
    {
        return [
            'body.required' => 'Your review is empty!',
            'body.min' => 'Too short review!',
            'assessment.required' => 'Rate the book!',
            'assessment.between' => 'The assessment should be in the range of 1 before 5.',
        ];
    }
}
