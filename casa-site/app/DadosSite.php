<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DadosSite extends Model
{
    protected $fillable = [
        'logo', 'titulo', 'slogan', 'banner', 'user_id',
    ];
}
