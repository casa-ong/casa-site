<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projeto;
use App\Noticia;
use App\User;
use App\Sobre;

class HomeController extends Controller
{

    protected $projeto;
    protected $noticia;
    protected $user;
    protected $sobre;

    public function __construct(Projeto $projeto, Noticia $noticia, User $user, Sobre $sobre)
    {
        $this->projeto = $projeto;
        $this->noticia = $noticia;
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

        $noticias = $this->noticia->where('publicado', 1)->latest()->paginate(3);

        return view('home', compact('n_projetos', 'n_voluntarios', 'projetos', 'sobre', 'noticias'));
    }

    public function adminIndex()
    {
        return view('admin.index');
    }
}
