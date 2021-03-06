<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projeto;
use App\Models\Publicacao;
use App\Models\User;
use App\Models\Sobre;
use App\Models\Doacao;

class HomeController extends Controller
{

    protected $projeto;
    protected $publicacao;
    protected $user;
    protected $sobre;
    protected $doacao;

    public function __construct(Projeto $projeto, Publicacao $publicacao, User $user, Sobre $sobre, Doacao $doacao)
    {
        $this->projeto = $projeto;
        $this->publicacao = $publicacao;
        $this->user = $user;
        $this->sobre = $sobre;
        $this->doacao = $doacao;
    }

    public function index() 
    {
        $sobre = $this->sobre->latest('updated_at')->first();

        $projetos = $this->projeto->where('publicado', 1);
        $n_projetos = $projetos->count();
        $projetos = $projetos->latest()->paginate(3);

        $n_voluntarios = $this->user->whereNotNull('email_verified_at')
                                    ->where('aprovado', '=', 1)->count();

        $totalArrecadado = $this->doacao->totalArrecadado();

        $slider = $this->publicacao
            ->where('publicado', 1)
            ->latest()->paginate(4);
            
        return view('home', compact(
            'n_projetos',
            'n_voluntarios',
            'projetos',
            'sobre',
            'slider',
            'totalArrecadado'
        ));
    }

    public function adminIndex()
    {
        return view('admin.index');
    }
}
