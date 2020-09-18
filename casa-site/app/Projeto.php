<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    protected $table = 'projetos';
    protected $fillable = [
        'nome', 'descricao', 'anexo', 'publicado',
    ];

    public function user() {
        return $this->hasMany('App\User');
    }

    public function despesa() {
        return $this->hasMany('App\Despesa');
    }

    public function doacao() {
        return $this->hasMany('App\Doacao');
    }
}
