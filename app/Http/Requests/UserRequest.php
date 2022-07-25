<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'first_name' => 'required|max:20|string',
            'last_name' => 'required|max:20|string',
            'email' => ['required','email', 'string', Rule::unique('users')->ignore(auth()->user()->id)],
            'mobile_no' => ['required', 'min:8', 'max:13', Rule::unique('users')->ignore(auth()->user()->id)],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'mobile_no.min' => 'The mobile no must be at least 8 digits.',
            'mobile_no.max' => 'The mobile no must not be greater than 13 digits.',
        ];
    }
}
