<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquete extends Model
{
    protected $fillable = [
        'texto', 'is_aberta',
    ];

    public function opcao()
    {
        return $this->hasMany('App\Opcao');
    }
}
