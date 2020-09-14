<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opcao extends Model
{
    protected $fillable = [
        'nome', 'foto', 'enquete_id',
    ];

    public function enquete() 
    {
        return $this->belongsTo('App\Enquete');
    }
}
