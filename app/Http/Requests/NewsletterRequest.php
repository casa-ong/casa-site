<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsletterRequest extends FormRequest
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
            'email_newsletter' => 'email|unique:newsletters|max:255',
        ];
    }
    
    public function messages() 
    {
        return [
            'email_newsletter.email' => 'Endereço de email digitado inválido',
            'email_newsletter.unique' => 'Endereço de email digitado já tem cadastro',
            
        ];
    }
}
