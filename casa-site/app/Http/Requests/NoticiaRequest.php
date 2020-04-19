<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticiaRequest extends FormRequest
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
            'titulo' => 'required|min:3',
            'manchete' => 'required|min:3',
            'texto' => 'required|min:3',
        ];
    }

    public static $messages = [
        'titulo.required' => 'O campo titulo deve ser preenchido',
        'titulo.min' => 'O campo titulo deve ter no mínimo 3 letras',
        'manchete.required' => 'O campo manchete deve ser preenchido',
        'manchete.min' => 'O campo manchete deve ter no mínimo 3 letras',
        'texto.required' => 'O texto da notícia deve ser preenchido',
        'texto.min' => 'O texto da notícia deve ter no mínimo 3 letras',
    ];
}
