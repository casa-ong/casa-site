<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'cpf', 'descricao', 'foto', 'profissao', 'admin', 'telefone', 'aprovado',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $rules = [
        'name' => 'required|min:3', //Definir os campos que são obrigatórios com required
        'cpf' => 'required|regex:/\d{3}\.\d{3}\.\d{3}\-\d{2}/', //Definir o mínimo de letras no campo com min:x
        'descricao' => 'required|min:3',
        'profissao' => 'required|min:3',
        'foto' => 'image',
        'email' => 'required|email|unique:users',
        'telefone' => 'regex:/\(?\d{2}\)?\s?\d{5}\-?\d{4}/',
        'password' => 'nullable|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/|confirmed',
    ];

    public static $messages = [
        'name.required' => 'O campo nome é obrigatório', //Definir a mensagem de erro para cada tipo de erro de cada campo
        'name.min' => 'O campo nome deve ter no mínimo 3 letras',
        'cpf.required' => 'O campo de cpf é obrigatório',
        'cpf.regex' => 'CPF inválido',
        'profissao.required' => 'O campo profissão deve ser preenchido',
        'profissao.min' => 'O campo profissão deve ter no mínimo 3 letras',
        'descricao.required' => 'O texto da descrição deve ser preenchido',
        'descricao.min' => 'O texto da descrição deve ter no mínimo 3 letras',
        'foto.image' => 'A imagem deve ser no formato jpeg, png, bmp, gif, svg ou webp',
        'email.required' => 'O campo de email é obrigatório',
        'email.email' => 'Digite um endereço de email',
        'email.unique' => 'O email digitado já foi cadastrado',
        'telefone.regex' => 'O número deve ser no formato (81)99999-9999',
        'password.regex' => 'Senha deve conter ao menos uma letra e um número e no mínimo 8 digitos',
        'password.confirmed' => 'As senhas não conferem'
    ];

    public function noticia() {
        return $this->hasMany('App\Noticia');
    }
}
