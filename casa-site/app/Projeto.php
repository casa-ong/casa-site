<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    protected $fillable = [
        'nome', 'descricao', 'anexo', 'publicado', 'user_id',
    ];

    public static $rules = [
        'user_id' => 'required|exists:users,id',
        'nome' => 'required|min:3',
        'descricao' => 'required|min:3',
    ];

    public static $messages = [
        'nome.required' => 'O campo nome deve ser preenchido',
        'nome.min' => 'O campo nome deve ter no mínimo 3 letras',
        'descricao.required' => 'O texto da descrição deve ser preenchido',
        'descricao.min' => 'O texto da descrição deve ter no mínimo 3 letras',
    ];
}
