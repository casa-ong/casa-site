<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VotarRequest extends FormRequest
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
            'opcao' => 'required|exists:opcaos,id',
	        'g-recaptcha-response' => 'required',
        ];
    }

    public function messages() {
        return [
            'opcao.required' => 'Você deve escolher uma das opção para votar',
            'opcao.exists' => 'A opção selecionada não existe, vote nas opções disponíveis',
            'g-recaptcha-response.required' => 'Você deve marcar o campo "Não sou um robô"',
        ];
    }
}
