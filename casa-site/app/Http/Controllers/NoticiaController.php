<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Noticia;
use Validator;
use App\Http\Requests\NoticiaRequest;

class NoticiaController extends Controller
{

    protected $noticia;

    public function __construct(Noticia $noticia) {
        $this->noticia = $noticia;
    }

    public function noticias() 
    {
        $noticias = $this->noticia->where('publicado', 1)->latest()->paginate(6);
        return view('site.noticias.noticias', compact('noticias'));
    }

    public function noticia($id) {
        $noticia = $this->noticia->find($id);
        return view('site.noticias.noticia', compact('noticia'));
    }
    
    // Metodo responsavel por abrir a pagina inicial das noticias
    public function index()
    {
        $registros = $this->noticia->all()->reverse();
        return view('admin.noticias.index', compact('registros'));
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
         
        if(isset($dados['publicado'])) {
            $dados['publicado'] = true;
        } else {
            $dados['publicado'] = false;
        }

        if(isset($dados['curtir'])) {
            $dados['curtir'] = true;
        } else {
            $dados['curtir'] = false;
        }

        if($request->hasFile('anexo')) {
            $anexo = $request->file('anexo');
            $num = rand(1111,9999);
            $dir = 'img/noticias';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'anexo_'.$num.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['anexo'] = $dir.'/'.$nomeAnexo;
        }

        
        $this->noticia->create($dados);
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

        if(isset($dados['publicado'])) {
            $dados['publicado'] = true;
        } else {
            $dados['publicado'] = false;
        }

        if(isset($dados['curtir'])) {
            $dados['curtir'] = true;
        } else {
            $dados['curtir'] = false;
        }
       
        if($request->hasFile('anexo')) {
            $anexo = $request->file('anexo');
            $num = rand(1111,9999);
            $dir = 'img/noticias';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'anexo_'.$num.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['anexo'] = $dir.'/'.$nomeAnexo;
        }

        $this->noticia->find($id)->update($dados);
        return redirect()->route('admin.noticias')->with('success', 'Notícia atualizada com sucesso!');
    }

    // Metodo da acao de apagar uma noticia
    public function deletar($id) 
    {
        $this->noticia->find($id)->delete();
        return redirect()->route('admin.noticias')->with('success', 'Notícia deletada com sucesso!');
    }

}
