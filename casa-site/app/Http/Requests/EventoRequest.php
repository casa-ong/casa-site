<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventoRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'nome' => 'required|min:3|max:255',
            'descricao' => 'required|min:3',
            'anexo' => 'nullable|image|max:255',
            'data' => 'date',
            'hora' => 'date_format:H:i',
        ];
    }
    
    public function messages() 
    {
        return [
            'nome.required' => 'O campo nome deve ser preenchido',
            'nome.min' => 'O campo nome deve ter no mínimo 3 letras',
            'descricao.required' => 'O texto da descrição deve ser preenchido',
            'descricao.min' => 'O texto da descrição deve ter no mínimo 3 letras',
            'anexo.image' => 'O arquivo sob validação deve ser uma imagem (jpeg, png, bmp, gif, svg ou webp)',
            'data.date' => 'A data deve ser no formato 01/01/2020',
            'hora.date_format' => 'A hora deve ser no formato 00:00',
        ];
    }
}
