<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContaPagamento extends Model
{
    protected $fillable = [
        'nome', 'cnpj', 'banco', 'agencia', 'operacao','numero_conta',
      ];

    
    public function doacao() {
        return $this->hasMany('App\Doacao');
    }
}
