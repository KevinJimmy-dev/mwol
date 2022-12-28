<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhraseRequest extends FormRequest
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
            'word_id' => ['required', 'exists:words,id'],
            'phrase' => ['required'],
            'translation' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'word_id.required' => 'Você precisa vincular a uma palavra especifica!',
            'word_id.exists' => 'Essa palavra não existe né?',
            'phrase.required' => 'Você precisa preencher o campo com a frase!',
            'translation.required' => 'Você precisa preencher o campo da tradução!',
        ];
    }
}
