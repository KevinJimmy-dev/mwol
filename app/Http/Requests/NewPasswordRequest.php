<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewPasswordRequest extends FormRequest
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
            'remember_token' => ['exists:users'],
            'password' => ['required', 'min:6', 'confirmed']
        ];
    }

    public function messages()
    {
        return [
            'password.min' => 'A senha deve conter no minimo 6 caracteres!',
            'password.confirmed' => 'As senhas não coincidem!',
            'password.required' => 'Insira sua nova senha!'
        ];
    }
}
