<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    protected $fillable = [
        'nome', 'descricao', 'anexo', 'publicado', 'user_id',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
