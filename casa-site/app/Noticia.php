<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $fillable = [
        'titulo', 'texto', 'anexo', 'publicado', 'user_id', 'manchete',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

}
