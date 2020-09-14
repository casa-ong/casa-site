<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Noticia;
use App\Projeto;
use App\Newsletter;
use Validator;
use App\Http\Requests\ProjetoRequest;
use App\Mail\ProjetoEmail;
use Mail;

class ProjetoController extends Controller
{

    protected $projeto;
    protected $newsletter;

    public function __construct(Projeto $projeto, Newsletter $newsletter) {
        $this->projeto = $projeto;
        $this->newsletter = $newsletter;

        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    }

    public function projetos() 
    {
        $projetos = $this->projeto->where('publicado', 1)->latest()->paginate(4);
        return view('site.projetos.projetos', compact('projetos'));
    }

    public function projeto($id) {
        $projeto = $this->projeto->find($id);

        $projetos = $this->projeto->where('publicado', 1)
                                ->where('id', '!=', $id)
                                ->latest()->take(2)->get();

        $noticias = Noticia::where('publicado', 1)->latest()->take(3)->get();

        if(!$projeto) {
            throw new ModelNotFoundException;
        }

        return view('site.projetos.projeto', compact('projeto', 'noticias', 'projetos'));
    }
    
    // Metodo responsavel por abrir a pagina inicial dos projetos
    public function index()
    {
        $registros = $this->projeto;
        $filtro['nome'] = 'Todos';
        
        if(request()->has('publicado') && request('publicado') != '') {
            $registros = $registros->where('publicado', request('publicado'));
            $filtro['publicado'] = request('publicado');
            $filtro['nome'] = (request('publicado') ? 'Public.' : 'Rasc.');
        }
        
        $registros = $registros->latest()->get();
        return view('admin.projetos.index', compact('registros', 'filtro'));
    }

    public function adicionar() 
    {
        return view('admin.projetos.adicionar');
    }

    // Método responsavel por salvar as informacoes do formulario de criacao no banco de dados
    public function salvar(ProjetoRequest $request) 
    {
        $request->validated();
        $dados = $request->all();
       
        if(isset($dados['publicado'])) {
            $dados['publicado'] = true;
        } else {
            $dados['publicado'] = false;
        }
        
        $projeto = $this->projeto->create($dados);

        if($request->hasFile('anexo')) {
            $anexo = $request->file('anexo');
            $num = $projeto->id;
            $dir = 'img/projetos';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'anexo_'.$num.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['anexo'] = $dir.'/'.$nomeAnexo;
        }

        $projeto->update($dados);

        if($projeto->publicado) {
            $this->emailProjeto($projeto);
        }

        return redirect()->route('admin.projetos')->with('success', 'Projeto adicionado com sucesso!');
    }

    // Método responsavel por abrir a pagina de editar um projeto
    public function editar($id) 
    {
        $registro = $this->projeto->find($id);
        return view('admin.projetos.editar', compact('registro'));
    }

    // Método responsavel por salvar as informacoes do formulario de edicao no banco de dados
    public function atualizar(ProjetoRequest $request, $id) 
    {
        $request->validated();
        $dados = $request->all();
        
        
        if(isset($dados['publicar'])) {
            $dados['publicado'] = true;
        } else if(isset($dados['rascunho'])) {
            $dados['publicado'] = false;
        }

        $projeto = $this->projeto->find($id);
        
        if($request->hasFile('anexo')) {
            $anexo = $request->file('anexo');
            $num = $projeto->id;
            $dir = 'img/projetos';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'anexo_'.$num.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['anexo'] = $dir.'/'.$nomeAnexo;
        }

        if(!$projeto->publicado && $dados['publicado'] == true) {
            $this->emailProjeto($projeto);
        }

        $projeto->update($dados);

        return redirect()->route('admin.projetos')->with('success', 'Projeto atualizado com sucesso!');
    }

    // Metodo da acao de apagar um projeto
    public function deletar($id) 
    {
        $this->projeto->find($id)->delete();
        return redirect()->route('admin.projetos')->with('success', 'Projeto deletado com sucesso!');
    }

    public function emailProjeto($projeto) 
    {
        $newsletters = $this->newsletter
                        ->where('receber_projetos', true)->get();

        $detalhes = [
            'url' => url('projeto/'.$projeto->id),
            'titulo' => 'Conheça nosso novo projeto '.$projeto->nome,
            'info' => 'Para saber mais sobre o projeto, clique no link abaixo',
            'newsletter_id' => '',
            'newsletter_token' => ''
        ];

        foreach ($newsletters as $newsletter) {
            $detalhes['newsletter_id'] = $newsletter->id;
            $detalhes['newsletter_token'] = $newsletter->token;
            Mail::to($newsletter->getEmailAttribute())->send(new ProjetoEmail($detalhes));
        }
    }

}
