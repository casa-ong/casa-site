<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Notifications\Notifiable;

class Sugestao extends Model
{

    use Notifiable;

    protected $fillable = [
        'assunto', 'mensagem', 'email', 'telefone', 'lida',
    ];
}
