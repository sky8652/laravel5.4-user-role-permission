<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'email' => 'required|unique:users|email',
            'tel'   => 'required|numeric|regex:/^1[34578][0-9]{9}$/|unique:users',
            'username'  => 'required|min:4|unique:users',
            'password'  => 'required|confirmed|min:6|max:14'
        ];
    }
}
