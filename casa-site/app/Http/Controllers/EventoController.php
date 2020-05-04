<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evento;
use Validator;
use App\Http\Requests\EventoRequest;

class EventoController extends Controller
{

    protected $evento;

    public function __construct(Evento $evento) 
    {
        $this->evento = $evento;
    }

    public function eventos() 
    {
        $eventos = $this->evento->all()->reverse();
        return view('site.eventos.eventos', compact('eventos'));
    }

    public function evento($id) {
        $evento = $this->evento->find($id);
        return view('site.eventos.evento', compact('evento'));
    }

    // Metodo responsavel por abrir a pagina de index dos eventos
    public function index()
    {
        $registros = $this->evento->all();
        return view('admin.eventos.index', compact('registros'));
    }

    // Metodo que vai servir para adiconar o evento
    public function adicionar() 
    {
        return view('admin.eventos.adicionar');
    }
    
    // Método responsavel por salvar as informacoes do formulario de criacao no banco de dados
    public function salvar(EventoRequest $request) 
    {
        $request->validated();
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

        $this->evento->create($dados);

        return redirect()->route('admin.eventos')->with('success', 'Evento adicionado com sucesso!');
    }

    // Método responsavel por abrir a pagina de editar um evento
    public function editar($id) 
    {
        $registro = $this->evento->find($id);
        return view('admin.eventos.editar', compact('registro'));
    }

    // Método responsavel por salvar as informacoes do formulario de edicao no banco de dados
    public function atualizar(EventoRequest $request, $id) 
    {
        $request->validated();
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

        $this->evento->find($id)->update($dados);

        return redirect()->route('admin.eventos')->with('success', 'Evento atualizado com sucesso!');
    }

    // Metodo da acao de apagar um evento
    public function deletar($id) 
    {
        $this->evento->find($id)->delete();
        return redirect()->route('admin.eventos')->with('success', 'Evento deletado com sucesso!');
    }



}
