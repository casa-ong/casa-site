<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContaPagamentoRequest extends FormRequest
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
            'nome' => 'required|min:3|max:255',
            'cnpj' => 'required|regex:/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/',
            'banco' => 'required|min:2',
            'agencia' => 'required|min:2',
            'operacao' => 'required|min:2',
            'numero_conta' => 'required|min:5',
        ];
    }

    public function messages()
    {
        return [
            
        ];
    }
}
