<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projeto;
use Validator;

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
    public function salvar(Request $request) 
    {

        $dados = $request->all();

        // Validar campos ao salvar
        $validarDados = Validator::make($dados, 
                                    $this->projeto::$rules,
                                    $this->projeto::$messages);

        if($validarDados->fails()) {
            return redirect()->back()->withErrors($validarDados->errors())->withInput();
        }
        
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

        return redirect()->route('admin.projetos');
    }

    // Método responsavel por abrir a pagina de editar um projeto
    public function editar($id) 
    {
        $registro = $this->projeto->find($id);
        return view('admin.projetos.editar', compact('registro'));
    }

    // Método responsavel por salvar as informacoes do formulario de edicao no banco de dados
    public function atualizar(Request $request, $id) 
    {
        $dados = $request->all();

        // Validar campos ao salvar
        $validarDados = Validator::make($dados, 
                                    $this->projeto::$rules,
                                    $this->projeto::$messages);

        if($validarDados->fails()) {
            return redirect()->back()->withErrors($validarDados->errors())->withInput();
        }
        
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

        return redirect()->route('admin.projetos');
    }

    // Metodo da acao de apagar um projeto
    public function deletar($id) 
    {
        $this->projeto->find($id)->delete();
        return redirect()->route('admin.projetos');
    }


}
