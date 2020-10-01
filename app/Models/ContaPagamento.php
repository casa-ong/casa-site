<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContaPagamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cnpj',
        'banco',
        'agencia',
        'operacao',
        'numero_conta',
    ];

    
    public function doacao()
    {
        return $this->hasMany('App\Models\Doacao');
    }
}
