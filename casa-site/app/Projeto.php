<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    protected $fillable = [
        'nome', 'descricao', 'anexos', 'publicado'
    ];
}
