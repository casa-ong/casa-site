<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Noticia;
use App\Newsletter;
use App\Projeto;
use Validator;
use App\Http\Requests\NoticiaRequest;
use App\Mail\NoticiaEmail;
use Mail;

class NoticiaController extends Controller
{

    protected $noticia;
    protected $newsletter;
    protected $projeto;

    public function __construct(Noticia $noticia, Newsletter $newsletter, Projeto $projeto) {
        $this->noticia = $noticia;
        $this->newsletter = $newsletter;
        $this->projeto = $projeto;

        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    }

    public function noticias() 
    {
        $noticias = $this->noticia->where('publicado', 1)->latest()->paginate(4);
        return view('site.noticias.noticias', compact('noticias'));
    }

    public function noticia($id) {

        $noticias = $this->noticia->where('publicado', 1)
                                ->where('id', '!=', $id)
                                ->latest()->take(3)->get();

        $projetos = $this->projeto->where('publicado', 1)->latest()->take(2)->get();

        $noticia = $this->noticia->where('id', $id)->where('publicado', true)->first();
        if(!$noticia) {
            throw new ModelNotFoundException;
        }

        return view('site.noticias.noticia', compact('noticia', 'noticias', 'projetos'));
    }
    
    // Metodo responsavel por abrir a pagina inicial das noticias
    public function index()
    {
        $registros = $this->noticia;
        $filtro['nome'] = 'Todos';

        if(request()->has('publicado') && request('publicado') != '') {
            $registros = $registros->where('publicado', request('publicado'));
            $filtro['publicado'] = request('publicado');
            $filtro['nome'] = (request('publicado') ? 'Public.' : 'Rasc.');
        }

        $registros = $registros->latest()->get();
        return view('admin.noticias.index', compact('registros', 'filtro'));
    }

    public function indexPublicados()
    {
        $registros = $this->noticia->where('publicado', true)->get();
        $lista = [
            'all' => false,
            'drafts' => false,
            'public' => true,
        ];

        return view('admin.noticias.index', compact('registros', 'lista'));
    }

    public function indexRascunhos()
    {
        $registros = $this->noticia->where('publicado', false)->get();
        $lista = [
            'all' => false,
            'drafts' => true,
            'public' => false,
        ];

        return view('admin.noticias.index', compact('registros', 'lista'));
    }
    
    public function adicionar() 
    {
        return view('admin.noticias.adicionar');
    }

    // Método responsavel por salvar as informacoes do formulario de criacao no banco de dados
    public function salvar(NoticiaRequest $request) 
    {
        $request->validated();
        $dados = $request->all();
         
        if(isset($dados['publicar'])) {
            $dados['publicado'] = true;
        } else if(isset($dados['rascunho'])) {
            $dados['publicado'] = false;
        }
  
        $noticia = $this->noticia->create($dados);
        
        if($request->hasFile('anexo')) {
            $anexo = $request->file('anexo');
            $num = $noticia->id;
            $dir = 'img/noticias';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'anexo_'.$num.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['anexo'] = $dir.'/'.$nomeAnexo;
        }

        $noticia->update($dados);

        if($noticia->publicado) {
            $this->emailNoticia($noticia);
        }

        return redirect()->route('admin.noticias')->with('success', 'Notícia adicionada com sucesso!');
    }

    // Método responsavel por abrir a pagina de editar uma noticia
    public function editar($id) 
    {
        $registro = $this->noticia->find($id);
        return view('admin.noticias.editar', compact('registro'));
    }

    // Método responsavel por salvar as informacoes do formulario de edicao no banco de dados
    public function atualizar(NoticiaRequest $request, $id) 
    {
        $request->validated();
        $dados = $request->all();

        if(isset($dados['publicar'])) {
            $dados['publicado'] = true;
        } else if(isset($dados['rascunho'])) {
            $dados['publicado'] = false;
        }

        $noticia = $this->noticia->find($id);
        
        if($request->hasFile('anexo')) {
            $anexo = $request->file('anexo');
            $num = $noticia->id;
            $dir = 'img/noticias';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'anexo_'.$num.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['anexo'] = $dir.'/'.$nomeAnexo;
        }

        if(!$noticia->publicado && $dados['publicado'] == true) {
            $this->emailNoticia($noticia);
        }

        $noticia->update($dados);
        return redirect()->route('admin.noticias')->with('success', 'Notícia atualizada com sucesso!');
    }

    // Metodo da acao de apagar uma noticia
    public function deletar($id) 
    {
        $this->noticia->find($id)->delete();
        return redirect()->route('admin.noticias')->with('success', 'Notícia deletada com sucesso!');
    }

    public function emailNoticia($noticia) 
    {
        $newsletters = $this->newsletter
                        ->where('receber_noticias', true)->get();

        $detalhes = [
            'url' => url('noticia/'.$noticia->id),
            'titulo' => $noticia->titulo,
            'texto' => $noticia->manchete,
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
