<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\User;
use App\Projeto;
use Validator;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{

    protected $user;

    public function __construct(User $user, Projeto $projeto) {
        $this->user = $user;
        $this->projeto = $projeto;
    }

    public function voluntarios() 
    {
        $nordeste = $this->user->where('aprovado', 1)
        ->where('estado', '=', 'AL')
        ->orWhere('estado', '=', 'BA')
        ->orWhere('estado', '=', 'CE')
        ->orWhere('estado', '=', 'PB')
        ->orWhere('estado', '=', 'MA')
        ->orWhere('estado', '=', 'PE')
        ->orWhere('estado', '=', 'PI')
        ->orWhere('estado', '=', 'RN')
        ->orWhere('estado', '=', 'SE')
        ->orderBy('name')->get();

        $centro = $this->user->where('aprovado', 1)
        ->where('estado', '=', 'DF')
        ->orWhere('estado', '=', 'GO')
        ->orWhere('estado', '=', 'MT')
        ->orWhere('estado', '=', 'MS')
        ->orderBy('name')->get();

        $sudeste = $this->user->where('aprovado', 1)
        ->where('estado', '=', 'ES')
        ->orWhere('estado', '=', 'MG')
        ->orWhere('estado', '=', 'RJ')
        ->orWhere('estado', '=', 'SP')
        ->orderBy('name')->get();

        $sul = $this->user->where('aprovado', 1)
        ->where('estado', '=', 'PR')
        ->orWhere('estado', '=', 'RS')
        ->orWhere('estado', '=', 'SC')
        ->orderBy('name')->get();

        return view('site.voluntarios.voluntarios', compact('nordeste', 'centro', 'sudeste', 'sul'));
    }

    public function voluntariosNorte() {
        $registros = $this->user->where('aprovado', '=', 1)
        ->where('estado', '=', 'AC')
        ->orWhere('estado', '=', 'AP')
        ->orWhere('estado', '=', 'AM')
        ->orWhere('estado', '=', 'PA')
        ->orWhere('estado', '=', 'RR')
        ->orWhere('estado', '=', 'RO')
        ->orWhere('estado', '=', 'TO')
        ->orderBy('name')->get();

        $estado = 'Norte';

        return view('site.voluntarios.regiao', compact('registros', 'estado'));
    }

    
    public function index() 
    {
        $registros = $this->user->all()->reverse();
        return view('admin.voluntarios.index', compact('registros'));
    }

    public function adicionar() 
    {
        $estados = $this->user::$estadosBrasileiros;
        $projetos = $this->projeto->all();
        return view('admin.voluntarios.adicionar', compact('estados', 'projetos'));
    }

    // Método responsavel por salvar as informacoes do formulario de criacao no banco de dados
    public function salvar(CreateUserRequest $request) 
    {
        $request->validated();
        $dados = $request->all();
        
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

        if(Auth::guest()) {
            return redirect()->route('site.voluntarios');
        }

        return redirect()->route('admin.voluntarios');

    }

    // Método responsavel por abrir a pagina de editar um projeto
    public function editar($id) 
    {
        $registro = $this->user->find($id);
        $estados = $this->user::$estadosBrasileiros;
        $projetos = $this->projeto->all();
        return view('admin.voluntarios.editar', compact('registro', 'estados', 'projetos'));
    }

    // Método responsavel por salvar as informacoes do formulario de edicao no banco de dados
    public function atualizar(UpdateUserRequest $request, $id) 
    {
        $request->validated();
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

        $user = $this->user->find($id);

        if ($user->cpf != $dados['cpf']) {
            return redirect()->back()->withErrors(['cpf' => 'Você não pode alterar o cpf']);
        }
        
        $user->update($dados);

        return redirect()->route('admin.voluntarios');
    }

    // Metodo da acao de apagar um projeto
    public function deletar($id) 
    {
        $this->user->find($id)->delete();
        return redirect()->route('admin.voluntarios');
    }
}
