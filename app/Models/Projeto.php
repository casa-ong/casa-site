<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Projeto extends Model
{
    use HasFactory;

    protected $table = 'projetos';

    protected $fillable = [
        'nome',
        'descricao',
        'anexo',
        'publicado',
    ];

    public function user() 
    {
        return $this->hasMany('App\Models\User');
    }

    public function despesa() 
    {
        return $this->hasMany('App\Models\Despesa');
    }

    public function doacao() 
    {
        return $this->hasMany('App\Models\Doacao');
    }
}
