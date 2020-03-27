<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evento;

class EventoController extends Controller
{

    public function eventos() 
    {
        $registros = Evento::all()->reverse();
        return view('eventos', compact('registros'));
    }

    // Metodo responsavel por abrir a pagina de index dos eventos
    public function index()
    {
        $registros = Evento::all();
        return view('admin.eventos.index', compact('registros'));
    }

    // Metodo que vai servir para adiconar o evento
    public function adicionar() 
    {
        return view('admin.eventos.adicionar');
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

        if($request->hasFile('anexo')) {
            $anexo = $request->file('anexo');
            $num = rand(1111,9999);
            $dir = 'img/eventos';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'anexo_'.$num.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['anexo'] = $dir.'/'.$nomeAnexo;
        }

        Evento::create($dados);

        return redirect()->route('admin.eventos');
    }

    // Método responsavel por abrir a pagina de editar um evento
    public function editar($id) 
    {
        $registro = Evento::find($id);
        return view('admin.eventos.editar', compact('registro'));
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

        if($request->hasFile('anexo')) {
            $anexo = $request->file('anexo');
            $num = rand(1111,9999);
            $dir = 'img/eventos';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'anexo_'.$num.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['anexo'] = $dir.'/'.$nomeAnexo;
        }

        Evento::find($id)->update($dados);

        return redirect()->route('admin.eventos');
    }

    // Metodo da acao de apagar um evento
    public function deletar($id) 
    {
        Evento::find($id)->delete();
        return redirect()->route('admin.eventos');
    }



}
