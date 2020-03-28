<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sugestao extends Model
{
    protected $fillable = [
        'assunto', 'mensagem', 'email', 'telefone', 'lida',
    ];
}
