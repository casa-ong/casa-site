<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Despesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'nota_fiscal',
        'valor',
        'user_id',
        'projeto_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function projeto()
    {
        return $this->belongsTo('App\Projeto');
    }
}
