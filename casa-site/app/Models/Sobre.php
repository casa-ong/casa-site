<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sobre extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo_site',
        'logo',
        'banner',
        'texto_sobre',
        'user_id',
    ];

   
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
