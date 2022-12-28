<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WordRequest extends FormRequest
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
            'language_id' => ['required', 'exists:languages,id'],
            'name' => ['required'],
            'translation' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Você precisa preencher o campo da palavra!',
            'language_id.required' => 'Você precisa selecionar um idioma!',
            'language_id.exists' => 'Esse idioma não foi cadastrado!',
            'translation.required' => 'Você precisa preencher o campo da tradução!',
        ];
    }
}
