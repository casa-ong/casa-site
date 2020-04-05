<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $fillable = [
        'titulo', 'texto', 'autor', 'anexo', 'publicado', 'curtir', 'user_id',
    ];

    public function user() {
        return $this->belongTo('App\User');
    }

}
