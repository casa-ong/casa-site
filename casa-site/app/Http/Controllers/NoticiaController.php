<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Noticia;

class NoticiaController extends Controller
{
    public function noticias() 
    {
        $registros = Noticia::all()->reverse();
        return view('noticias', compact('registros'));
    }
    
    // Metodo responsavel por abrir a pagina inicial das noticias
    public function index()
    {
        $registros = Noticia::all();
        return view('admin.noticias.index', compact('registros'));
    }

    
    public function adicionar() 
    {
        return view('admin.noticias.adicionar');
    }

    // Método responsavel por salvar as informacoes do formulario de criacao no banco de dados
    public function salvar(Request $request) 
    {
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

        
        Noticia::create($dados);
        return redirect()->route('admin.noticias');
    }

    // Método responsavel por abrir a pagina de editar uma noticia
    public function editar($id) 
    {
        $registro = Noticia::find($id);
        return view('admin.noticias.editar', compact('registro'));
    }

    // Método responsavel por salvar as informacoes do formulario de edicao no banco de dados
    public function atualizar(Request $request, $id) 
    {
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

         
        if(isset($dados['curtir'])) {
            $dados['curtir'] = true;
        } else {
            $dados['curtir'] = false;
        }

        Noticia::find($id)->update($dados);
        return redirect()->route('admin.noticias');
    }

    // Metodo da acao de apagar uma noticia
    public function deletar($id) 
    {
        Noticia::find($id)->delete();
        return redirect()->route('admin.noticias');
    }

}
