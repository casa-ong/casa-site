<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Opcao extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'foto',
        'enquete_id',
    ];

    public function enquete() 
    {
        return $this->belongsTo('App\Enquete');
    }
}
