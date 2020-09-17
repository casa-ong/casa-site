<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    protected $fillable = [
        'telefone', 'email', 'instagram', 'twitter', 'facebook', 'sobre_id',
    ];

   
    public function sobre() {
        return $this->belongsTo('App\Sobre');
    }
}
