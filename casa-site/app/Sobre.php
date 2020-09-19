<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sobre extends Model
{
    protected $fillable = [
        'titulo_site', 'logo', 'banner', 'titulo_sobre', 'texto_sobre', 'user_id',
    ];

   
    public function user() {
        return $this->belongsTo('App\User');
    }
}
