<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnqueteRequest extends FormRequest
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
            'texto' => 'required|min:10|max:255',
            'user_id' => 'required|exists:users,id',
            'opcao.*' => 'required|min:3|max:255',
            'foto.*' => 'image',
        ];
    }

    public function messages() 
    {
        return [
            'texto.required' => 'O campo de texto deve ser preenchido',
            'texto.min' => 'O campo de texto deve ter no mínimo 10 letras',
            'texto.max' => 'O campo de texto não deve ter mais que 255 letras',
            'user_id.required' => 'É preciso estar logado para criar enquetes',
            'opcao.min' => 'É necessário cadastrar ao menos duas opções',
            'opcao.*.required' => 'As opções não podem ser vazias',
            'opcao.*.min' => 'As opções devem ter ao menos 3 letras cada',
            'opcao.*.max' => 'O campo de texto não deve ter mais que 255 letras',
            'foto.*.image' => 'O arquivo sob validação deve ser uma imagem (jpeg, png, bmp, gif, svg ou webp)',
        ];
    }
}
