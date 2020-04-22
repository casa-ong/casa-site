<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SobreRequest extends FormRequest
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
        'titulo_site' => 'required|min:3',
        'logo' => 'required|image',
        'slogan' => 'required|min:3',
        'banner' => 'image',
        'texto_sobre' => 'required|min:10',
        'anexo_sobre' => 'image',
        'email' => 'nullable|email',
        'telefone' => 'nullable|regex:/\(?\d{2}\)?\s?\d{5}\-?\d{4}/', 
        'instagram' => 'nullable|regex:https/?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)/',
        'twitter' => 'nullable|regex:https/?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)/',
        'facebook' => 'nullable|regex:https/?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)/',
        ];
    }
    public static $messages = [
        'titulo_site.required' => 'O título do site é obrigatório',
        'titulo_site.min' => 'O título deve ter no mínimo 3 letras',
        'logo.required' => 'O logo o site é obrigatório',
        'logo.image' => 'O logo deve ser no formato jpeg, png, bmp, gif, svg ou webp',
        'slogan.required' => 'O slogan do site é obrigatório',
        'slogan.min' => 'O slogan do site deve ter no mínimo 3 letras',
        'banner.image' => 'O banner deve ser no formato jpeg, png, bmp, gif, svg ou webp',
        'texto_sobre.required' => 'O texto do sobre é obrigatório',
        'texto_sobre.min' => 'O texto do sobre deve ter no mínimo 3 letras',
        'anexo_sobre.image' => 'O anexo do sobre deve ser no formato jpeg, png, bmp, gif, svg ou webp',
        'email.email' => 'Digite um endereço de email válido',
        'telefone.regex' => 'O número deve ser no formato (81)99999-9999', 
        'instagram.regex' => 'O campo do Instagram deve conter um link, exemplo: https://instagram.com/exemplo',
        'twitter.regex' => 'O campo do Twitter deve conter um link, exemplo: https://twitter.com/exemplo',
        'facebook.regex' => 'O campo do Facebook deve conter um link, exemplo: https://facebook.com/exemplo',
    ];
}
