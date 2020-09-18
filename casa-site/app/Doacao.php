<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doacao extends Model
{
    protected $fillable = [
        'nome', 'valor', 'meioPagamento', 'isAnonimo', 'comprovanteAnexo', 'contaPagamento_id', 'projeto_id',
      ]; 
      
    public function contaPagamento()
    {
        return $this->belongsTo('App\ContaPagamento');
    } 
    
    public function projeto()
    {
        return $this->belongsTo('App\Projeto');
    }
}
