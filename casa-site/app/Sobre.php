<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sobre extends Model
{
    protected $fillable = [
        'titulo_site', 'logo', 'slogan', 'banner', 'titulo_sobre', 'texto_sobre', 'anexo_sobre', 'telefone', 'email', 'instagram', 'twitter', 'facebook', 'user_id',
    ];

   
    public function user() {
        return $this->belongsTo('App\User');
    }
}
