<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'valor',
        'meio_pagamento',
        'is_aprovado',
        'is_anonimo',
        'comprovante_anexo',
        'conta_pagamento_id',
        'projeto_id',
    ]; 
      
    public function conta_pagamento()
    {
        return $this->belongsTo('App\Models\ContaPagamento');
    } 
    
    public function projeto()
    {
        return $this->belongsTo('App\Models\Projeto');
    }

    public function totalArrecadado()
    {
        $registros = $this->all();

        $total = 0;
        foreach($registros as $registro) {
            $total += $registro->valor;
        }

        return $total;
    }
}
