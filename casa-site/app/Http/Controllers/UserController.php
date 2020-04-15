<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\User;
use Validator;

class UserController extends Controller
{

    protected $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function voluntarios() 
    {
        $registros = $this->user->all()->reverse();
        return view('voluntarios', compact('registros'));
    }

    
    public function index() 
    {
        $registros = $this->user->all()->reverse();
        return view('admin.voluntarios.index', compact('registros'));
    }

    public function adicionar() 
    {
        return view('admin.voluntarios.adicionar');
    }

    // Método responsavel por salvar as informacoes do formulario de criacao no banco de dados
    public function salvar(Request $request) 
    {
        $dados = $request->all();
        
        // Validar campos ao salvar
        $validarDados = Validator::make($dados, 
                                $this->user::$rules, 
                                $this->user::$messages);
            
        if($validarDados->fails()) { //Isso retorna o erro com mensagem para view
            return redirect()->back()->withErrors($validarDados->errors())->withInput();
        }

        if(Auth::guest() && (isset($dados['admin']) || isset($dados['aprovado']))) {
            return redirect()->route('site.voluntario.adicionar');
        }
        
        if(!isset($dados['password'])) {
            $dados['password'] = 'admin';
        }

        $dados['password'] = bcrypt($dados['password']);
        

        if(isset($dados['admin'])) {
            $dados['admin'] = true;
        } else {
            $dados['admin'] = false;
        }

        if(isset($dados['aprovado'])) {
            $dados['aprovado'] = true;
        } else {
            $dados['aprovado'] = false;
        }

        if($request->hasFile('foto')) {
            $anexo = $request->file('foto');
            $num = rand(1111,9999);
            $dir = 'img/voluntarios/';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'foto_'.$dados['cpf'].'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['foto'] = $dir.'/'.$nomeAnexo;
        }

        $this->user->create($dados);

        return redirect()->route('site.voluntarios');
    }

    // Método responsavel por abrir a pagina de editar um projeto
    public function editar($id) 
    {
        $registro = $this->user->find($id);
        return view('admin.voluntarios.editar', compact('registro'));
    }

    // Método responsavel por salvar as informacoes do formulario de edicao no banco de dados
    public function atualizar(Request $request, $id) 
    {
        $dados = $request->all();

        $dados['password'] = bcrypt($dados['password']);
        
        if(isset($dados['admin'])) {
            $dados['admin'] = true;
        } else {
            $dados['admin'] = false;
        }

        if(isset($dados['aprovado'])) {
            $dados['aprovado'] = true;
        } else {
            $dados['aprovado'] = false;
        }

        if($request->hasFile('foto')) {
            $anexo = $request->file('foto');
            $num = rand(1111,9999);
            $dir = 'img/voluntarios';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'foto_'.$dados['cpf'].'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['foto'] = $dir.'/'.$nomeAnexo;
        }

        $this->user->find($id)->update($dados);

        return redirect()->route('admin.voluntarios');
    }

    // Metodo da acao de apagar um projeto
    public function deletar($id) 
    {
        $this->user->find($id)->delete();
        return redirect()->route('admin.voluntarios');
    }
}
