<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
        'name' => 'required|min:3', //Definir os campos que são obrigatórios com required
        'cpf' => 'required|regex:/\d{3}\.\d{3}\.\d{3}\-\d{2}/', //Definir o mínimo de letras no campo com min:x
        'descricao' => 'required|min:3',
        'profissao' => 'required|min:3',
        'foto' => 'image|dimensions:ratio=1/1',
        'email' => 'required|email|unique:users',
        'telefone' => 'regex:/\(?\d{2}\)?\s?\d{5}\-?\d{4}/',
        'password' => 'nullable|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/|confirmed',
        'estado' => 'required|min:2|max:2',
        'cidade' => 'nullable|min:3',
        'nascimento' => 'date',
        'projeto_id' => 'exists:projetos,id',
        ];
    }

    public function messages() 
    {
        return [
            'name.required' => 'O campo nome é obrigatório', //Definir a mensagem de erro para cada tipo de erro de cada campo
            'name.min' => 'O campo nome deve ter no mínimo 3 letras',
            'cpf.required' => 'O campo de cpf é obrigatório',
            'cpf.regex' => 'CPF inválido',
            'profissao.required' => 'O campo profissão deve ser preenchido',
            'profissao.min' => 'O campo profissão deve ter no mínimo 3 letras',
            'descricao.required' => 'O texto da descrição deve ser preenchido',
            'descricao.min' => 'O texto da descrição deve ter no mínimo 3 letras',
            'foto.image' => 'O arquivo sob validação deve ser uma imagem (jpeg, png, bmp, gif, svg ou webp)',
            'foto.dimensions' => 'A foto de perfil deve ser quadrada',
            'email.required' => 'O campo de email é obrigatório',
            'email.email' => 'Digite um endereço de email válido',
            'email.unique' => 'O email digitado já foi cadastrado',
            'telefone.regex' => 'O número deve ser no formato (81)99999-9999',
            'password.regex' => 'Senha deve conter ao menos uma letra e um número e no mínimo 8 digitos',
            'password.confirmed' => 'As senhas não conferem',
            'estado.required' => 'O estado é obrigatório',
            'estado.min|estado.max' => 'O estado deve ser selecionado',
            'cidade.min' => 'O nome da cidade deve ter ao menos 3 caracteres',
            'nascimento.date' => 'A data de nascimento está inválida',
            'projeto_id.exists' => 'O projeto deve deve ser cadastrado antes',
        ];
    }

}
