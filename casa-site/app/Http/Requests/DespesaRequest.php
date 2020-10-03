<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DespesaRequest extends FormRequest
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
            'nota_fiscal' => 'required|mimes:jpeg,bmp,png,svg,webp,pdf',
            'valor' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'nota_fiscal.mimes' => 'O arquivo da nota fiscal deve ser uma imagem (jpeg, png, bmp, svg ou webp) ou um pdf',
        ];
    }
}
