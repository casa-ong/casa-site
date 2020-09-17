<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquete extends Model
{
  protected $fillable = [
    'nome', 'descricao', 'nota_fiscal', 'valor', 'user_id', 'projeto_id'
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
