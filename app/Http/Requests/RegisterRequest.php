<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'min:3', 'max:50'],
            'nickname' => ['required', 'min:3', 'max:16'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:3', 'max:16', 'confirmed']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Você precisa preencher o campo nome!',
            'name.min' => 'Você possui mais de três caracteres no nome né?',
            'name.max' => 'Você não possui mais de 50 caracteres no nome né?',
            'nickname.required' => 'Você precisa preencher o campo apelido!',
            'nickname.min' => 'Seu apelido deve conter no mínimo 3 caracteres!',
            'nickname.max' => 'Seu apelido deve conter no máximo 16 caracteres!',
            'email.required' => 'Você precisa preencher o campo e-mail!',
            'email.email' => 'Isso não é um e-mail né?',
            'password.required' => 'Você precisa cadastrar uma senha!',
            'password.min' => 'Sua senha deve conter no mínimo 3 caracteres!',
            'password.max' => 'Sua senha deve conter no máximo 16 caracteres!',
            'password.confirmed' => 'As senhas devem coincidir!'
        ];
    }
}
