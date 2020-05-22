<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = [
        'nome', 'descricao', 'anexo', 'data', 'publicado', 'user_id', 'hora'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
