<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoacaoRequest extends FormRequest
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
            'nome' => 'nullable|min:5|max:255',
            'valor' => 'required|numeric',
            'meio_pagamento' => 'required',
            'is_anonimo' => 'required',
            'conta_pagamento_id' => 'nullable|exists:conta_pagamentos,id', 
            'projeto_id' => 'nullable|exists:projetos,id',
            ];
    }

    public function messages() 
    {
        return [
            'nome.required' => 'O campo nome deve ser preenchido',
            'nome.min' => 'O campo de nome deve ter no mínimo 5 letras',
            'nome.max' => 'O campo de nome não deve ter mais que 255 letras',
            'valor.required' => 'O campo valor precisa ser preenchido',
            'valor.numeric' => 'O campo valor precisa ser numérico',
            'meio_pagamento.required' => 'O campo meio de pagemento deve ser preenchido',
            'is_anonimo.required' => 'O campo anônimo precisa ser marcado',
            
            ];
    }
}
