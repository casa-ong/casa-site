<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contato extends Model
{
    use HasFactory;

    protected $fillable = [
        'telefone',
        'email',
        'instagram',
        'twitter',
        'facebook',
        'sobre_id',
    ];

   
    public function sobre()
    {
        return $this->belongsTo('App\Sobre');
    }
}
