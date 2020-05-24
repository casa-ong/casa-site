<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Notifications\Notifiable;

class Newsletter extends Model
{
    use Notifiable;

    protected $fillable = [
        'email_newsletter', 'receber_eventos', 'receber_projetos', 'receber_noticias',
    ];

    public function user() {
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
