<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enquete extends Model
{
    use HasFactory;

    protected $fillable = [
        'texto',
        'is_aberta',
        'user_id',
    ];

    public function opcao()
    {
        return $this->hasMany('App\Models\Opcao');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
