<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doacao extends Model
{
    protected $fillable = [
        'nome', 'valor', 'meio_pagamento', 'is_anonimo', 'comprovante_anexo', 'conta_pagamento_id', 'projeto_id',
      ]; 
      
    public function conta_pagamento()
    {
        return $this->belongsTo('App\ContaPagamento');
    } 
    
    public function projeto()
    {
        return $this->belongsTo('App\Projeto');
    }
}
