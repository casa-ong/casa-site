<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projeto;
use App\Noticia;
use App\Evento;
use App\User;
use App\Sobre;

class HomeController extends Controller
{

    protected $projeto;
    protected $noticia;
    protected $evento;
    protected $user;
    protected $sobre;

    public function __construct(Projeto $projeto, Noticia $noticia, Evento $evento, User $user, Sobre $sobre)
    {
        $this->projeto = $projeto;
        $this->noticia = $noticia;
        $this->evento = $evento;
        $this->user = $user;
        $this->sobre = $sobre;
    }

    public function index() 
    {
        $sobre = $this->sobre->latest('updated_at')->first();

        $projetos = $this->projeto->where('publicado', 1);
        $n_projetos = $projetos->count();
        $projetos = $projetos->latest()->paginate(3);

        $n_voluntarios = $this->user->whereNotNull('email_verified_at')
                                    ->where('aprovado', '=', 1)->count();

        $noticias = $this->noticia->where('publicado', 1)->latest()->paginate(2);
        $eventos = $this->evento->where('publicado', 1)->latest()->paginate(2);
        $slider = $this->criarArrayNoticiasEventos($noticias, $eventos);

        return view('home', compact('n_projetos', 'n_voluntarios', 'projetos', 'sobre', 'slider'));
    }

    public function adminIndex()
    {
        return view('admin.index');
    }

    private function criarArrayNoticiasEventos($noticias, $eventos) 
    {
        $slider = array();

        foreach($noticias as $noticia) {
            array_push($slider, $noticia);
        }

        foreach($eventos as $evento) {
            array_push($slider, $evento);
        }

        return $slider;
    }
}
