<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $fillable = [
        'email', 'receber_eventos', 'receber_projetos', 'receber_noticias',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

}
