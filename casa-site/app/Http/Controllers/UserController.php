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
use App\Notifications\UserRegisteredSuccessfully;
use Notification;

class UserController extends Controller
{

    protected $user;

    public function __construct(User $user, Projeto $projeto) {
        $this->user = $user;
        $this->projeto = $projeto;
    }

    public function voluntarios() 
    {
        return view('site.voluntarios.voluntarios');
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

    public function voluntariosNordeste() {
        $registros = $this->user->where('aprovado', 1)
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

        $estado = 'Nordeste';

        return view('site.voluntarios.regiao', compact('registros', 'estado'));
    }

    public function voluntariosCentro() {
        $registros = $this->user->where('aprovado', 1)
        ->where('estado', '=', 'DF')
        ->orWhere('estado', '=', 'GO')
        ->orWhere('estado', '=', 'MT')
        ->orWhere('estado', '=', 'MS')
        ->orderBy('name')->get();

        $estado = 'Centro';

        return view('site.voluntarios.regiao', compact('registros', 'estado'));
    }

    public function voluntariosSudeste() {
        $registros = $this->user->where('aprovado', 1)
        ->where('estado', '=', 'ES')
        ->orWhere('estado', '=', 'MG')
        ->orWhere('estado', '=', 'RJ')
        ->orWhere('estado', '=', 'SP')
        ->orderBy('name')->get();

        $estado = 'Sudeste';
        return view('site.voluntarios.regiao', compact('registros', 'estado'));
    }

    public function voluntariosSul() {
        $registros = $this->user->where('aprovado', 1)
        ->where('estado', '=', 'PR')
        ->orWhere('estado', '=', 'RS')
        ->orWhere('estado', '=', 'SC')
        ->orderBy('name')->get();

        $estado = 'Sul';

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

    public function homeAdicionar(Request $request) 
    {
        $registro = new User();
        $registro->email = $request['email'];

        $request->validate([
            'email' => 'email|unique:users',
        ], [
            'email.email' => 'Endereço de email digitado inválido',
            'email.unique' => 'Endereço de email digitado já tem cadastro',
        ]);

        $estados = $this->user::$estadosBrasileiros;
        $projetos = $this->projeto->all();
        return view('admin.voluntarios.adicionar', compact('estados', 'projetos', 'registro'));
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

        $user = $this->user->where('email', $dados['email'])->first();
        Notification::send($user, new UserRegisteredSuccessfully($user));

        if(Auth::guest()) {
            return redirect()->route('site.voluntarios')->with('success', 'Inscrição feita com sucesso! Verifique seu email e aguarde a aprovação por nossos representantes.');;
        }

        return redirect()->route('admin.voluntarios')->with('success', 'Voluntário adicionado com sucesso!');

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
        } else if($user->email != $dados['email']) {
            return redirect()->back()->withErrors(['email' => 'Você não pode alterar o email']);
        }
        
        $user->update($dados);

        return redirect()->route('admin.voluntarios')->with('success', 'Voluntário atualizado com sucesso!');
    }

    // Metodo da acao de apagar um projeto
    public function deletar($id) 
    {
        $this->user->find($id)->delete();
        return redirect()->route('admin.voluntarios')->with('success', 'Voluntário deletado com sucesso!');
    }
}
