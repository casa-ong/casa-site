<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContaPagamento extends Model
{
    protected $fillable = [
        'nome', 'cnpj', 'banco', 'agencia', 'operacao','numeroConta',
      ];

    
    public function doacao() {
        return $this->hasMany('App\Doacao');
    }
}
