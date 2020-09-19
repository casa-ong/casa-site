<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjetoRequest extends FormRequest
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
            'descricao' => 'required|min:3',
            'anexo' => 'nullable|image',
        ];
    }

    public function messages() 
    {
        return  [
            'nome.required' => 'O campo nome deve ser preenchido',
            'nome.min' => 'O campo nome deve ter no mínimo 3 letras',
            'descricao.required' => 'O texto da descrição deve ser preenchido',
            'descricao.min' => 'O texto da descrição deve ter no mínimo 3 letras',
            'anexo.image' => 'O arquivo sob validação deve ser uma imagem (jpeg, png, bmp, gif, svg ou webp)',
        ];
    }
}
