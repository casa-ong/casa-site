<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projeto;
use Validator;
use App\Http\Requests\ProjetoRequest;

class ProjetoController extends Controller
{

    protected $projeto;

    public function __construct(Projeto $projeto) {
        $this->projeto = $projeto;
    }

    public function projetos() 
    {
        $projetos = $this->projeto->where('publicado', 1)->latest()->paginate(6);
        return view('site.projetos.projetos', compact('projetos'));
    }

    public function projeto($id) {
        $projeto = $this->projeto->find($id);
        return view('site.projetos.projeto', compact('projeto'));
    }
    
    // Metodo responsavel por abrir a pagina inicial dos projetos
    public function index()
    {
        $registros = $this->projeto->all()->reverse();
        return view('admin.projetos.index', compact('registros'));
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

        if($request->hasFile('anexo')) {
            $anexo = $request->file('anexo');
            $num = rand(1111,9999);
            $dir = 'img/projetos';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'anexo_'.$num.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['anexo'] = $dir.'/'.$nomeAnexo;
        }

        $this->projeto->create($dados);

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
        
        
        if(isset($dados['publicado'])) {
            $dados['publicado'] = true;
        } else {
            $dados['publicado'] = false;
        }

        if($request->hasFile('anexo')) {
            $anexo = $request->file('anexo');
            $num = rand(1111,9999);
            $dir = 'img/projetos';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'anexo_'.$num.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['anexo'] = $dir.'/'.$nomeAnexo;
        }

        $this->projeto->find($id)->update($dados);

        return redirect()->route('admin.projetos')->with('success', 'Projeto atualizado com sucesso!');
    }

    // Metodo da acao de apagar um projeto
    public function deletar($id) 
    {
        $this->projeto->find($id)->delete();
        return redirect()->route('admin.projetos')->with('success', 'Projeto deletado com sucesso!');
    }


}
