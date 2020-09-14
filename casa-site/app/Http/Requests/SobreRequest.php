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
        'titulo_site' => 'min:3|max:255',
        'logo' => 'image|max:255',
        'slogan' => 'min:3|max:255',
        'banner' => 'image|max:255',
        'texto_sobre' => 'min:10',
        'anexo_sobre' => 'image|max:255',
        'email' => 'nullable|email|max:255',
        'telefone' => 'nullable|regex:/\(?\d{2}\)?\s?\d{5}\-?\d{4}/', 
        'instagram' => 'nullable|url|max:255',
        'twitter' => 'nullable|url|max:255',
        'facebook' => 'nullable|url|max:255',
        ];
    }
    public function messages() 
    {
        return  [
            'titulo_site.min' => 'O título deve ter no mínimo 3 letras',
            'logo.image' => 'O logo deve ser no formato jpeg, png, bmp, gif, svg ou webp',
            'slogan.min' => 'O slogan do site deve ter no mínimo 3 letras',
            'banner.image' => 'O banner deve ser no formato jpeg, png, bmp, gif, svg ou webp',
            'texto_sobre.min' => 'O texto do sobre deve ter no mínimo 3 letras',
            'anexo_sobre.image' => 'O anexo do sobre deve ser no formato jpeg, png, bmp, gif, svg ou webp',
            'email.email' => 'Digite um endereço de email válido',
            'telefone.regex' => 'O número deve ser no formato (81)99999-9999', 
            'instagram.url' => 'O campo do Instagram deve conter um link, exemplo: https://instagram.com/exemplo',
            'twitter.url' => 'O campo do Twitter deve conter um link, exemplo: https://twitter.com/exemplo',
            'facebook.url' => 'O campo do Facebook deve conter um link, exemplo: https://facebook.com/exemplo',
        ];

    }
}