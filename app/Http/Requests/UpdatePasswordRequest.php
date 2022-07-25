<?php

namespace App\Http\Requests;

use App\Rules\ValidCurrentUserPassword;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'old_password' => ['required',new ValidCurrentUserPassword()],
            'new_password' => 'required|min:8|different:old_password',
            'confirm_password' => 'required|same:new_password'
        ];
    }
}
