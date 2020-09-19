<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Mail\EventoEmail;
use App\Mail\NoticiaEmail;
use Mail;

class Publicacao extends Model
{
    protected $fillable = [
        'nome', 'descricao', 'anexo', 'data', 'publicado', 'user_id', 'hora', 'tipo',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function emailEvento($evento, $newsletters) 
    {
        $detalhes = [
            'url' => url('evento/'.$evento->id),
            'titulo' => $evento->nome,
            'texto' => 'O evento acontecerá no dia '.date('d/m/Y', strtotime($evento->data)).' às '.date('H:i', strtotime($evento->data)),
            'info' => 'Para ver mais detalhes do evento clique no link abaixo',
            'newsletter_id' => '',
            'newsletter_token' => ''
        ];

        foreach ($newsletters as $newsletter) {
            $detalhes['newsletter_id'] = $newsletter->id;
            $detalhes['newsletter_token'] = $newsletter->token;
            Mail::to($newsletter->getEmailAttribute())->send(new EventoEmail($detalhes));
        }
    }

    public function emailNoticia($noticia, $newsletters) 
    {
        $detalhes = [
            'url' => url('noticia/'.$noticia->id),
            'titulo' => $noticia->nome,
            'texto' => 'A notícia completa está disponível para leitura no site através do link a seguir.',
            'newsletter_id' => '',
            'newsletter_token' => ''
        ];

        foreach ($newsletters as $newsletter) {
            $detalhes['newsletter_id'] = $newsletter->id;
            $detalhes['newsletter_token'] = $newsletter->token;
            Mail::to($newsletter->getEmailAttribute())->send(new NoticiaEmail($detalhes));
        }
    }
}
