<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Newsletter extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email_newsletter',
        'receber_eventos',
        'receber_projetos',
        'receber_noticias',
        'token',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getEmailAttribute()
    {
        return $this->email_newsletter;
    }

    public function getId()
    {
        return $this->id;
    }

}
