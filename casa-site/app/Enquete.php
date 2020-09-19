<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquete extends Model
{
    protected $fillable = [
        'texto', 'is_aberta', 'user_id',
    ];

    public function opcao()
    {
        return $this->hasMany('App\Opcao');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
