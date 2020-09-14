<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SugestaoRequest extends FormRequest
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
            'assunto' => 'required|min:3|max:255',
            'mensagem' => 'required|min:3',
            'email' => 'required|email|max:255',
            'telefone' => 'regex:/\(?\d{2}\)?\s?\d{5}\-?\d{4}/',
        ];
    }
    public function messages() 
    {
        return  [
            'assunto.required' => 'O campo assunto é obrigatório',
            'assunto.min' => 'O campo assunto deve ter no mínimo 3 letras',
            'mensagem.required' => 'O texto da mensagem deve ser preenchido',
            'mensagem.min' => 'O texto da mensagem deve ter no mínimo 3 letras',
            'email.required' => 'O campo de email é obrigatório',
            'email.email' => 'Digite um endereço de email válido',
            'telefone.regex' => 'O número deve ser no formato (81)99999-9999',
            
        ];
    }   
}
