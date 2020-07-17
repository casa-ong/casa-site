<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Notifications\UserRegisteredSuccessfully;
use App\Notifications\VoluntarioAprovadoNotification;
use App\Notifications\AdminAprovadoNotification;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Notification;
use Validator;
use Auth;
use App\User;
use App\Projeto;
use App\Noticia;

class UserController extends Controller
{

    protected $user;
    protected $projeto;
    protected $noticia;

    public function __construct(User $user, Projeto $projeto, Noticia $noticia) {
        $this->user = $user;
        $this->projeto = $projeto;
        $this->noticia = $noticia;
    }

    public function index() 
    {
        $registros = $this->user->get()->reverse();
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
        $estados = $this->user::$estadosBrasileiros;
        $projetos = $this->projeto->all();

        $registro = $this->user->where('email', $request['email'])->first();
        if($registro && !$registro->email_verified_at) {
            return redirect()->back()->withErrors(['emailNotVerified' => 'E-mail já existe, mas não foi verificado. <strong>Clique abaixo para receber um novo link de verificação por e-mail</strong>.'])->withInput();
        }

        $registro = new User();
        $registro->email = $request['email'];

        $request->validate([
            'email' => 'email|unique:users',
        ], [
            'email.email' => 'Endereço de email digitado inválido',
            'email.unique' => 'Endereço de email digitado já tem cadastro',
        ]);

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
            $dados['password'] = bcrypt(Str::random(8));
        }

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

    public function ver($id) 
    {
        $registro = $this->user->find($id);
        if(!$registro) {
            throw new ModelNotFoundException;
        }

        $estados = $this->user::$estadosBrasileiros;
        foreach($estados as $estado) {
            if($estado[0] == $registro->estado) {
                $registro->estado = $estado[1];
            }
        }
        return view('admin.voluntarios.ver', compact('registro', 'estados'));
    }

    // Método responsavel por abrir a pagina de editar um projeto
    public function editar($id) 
    {
        $user = Auth::user();
        $registro = $user;

        if($id != $user->id) {
            $registro = $this->user->where('id', $id)->where('admin', 0)->first();
        }
        
        if(!$registro) {
            throw new ModelNotFoundException;
        }

        $estados = $this->user::$estadosBrasileiros;
        $projetos = $this->projeto->all();
        return view('admin.voluntarios.editar', compact('registro', 'estados', 'projetos'));
    }

    // Método responsavel por salvar as informacoes do formulario de edicao no banco de dados
    public function atualizar(UpdateUserRequest $request, $id) 
    {
        $request->validated();
        $dados = $request->all();
        
        if($request->hasFile('foto')) {
            $anexo = $request->file('foto');
            $dir = 'img/voluntarios';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'foto_'.$dados['cpf'].'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['foto'] = $dir.'/'.$nomeAnexo;
        }

        $user = $this->user->find($id);

        if(isset($dados['admin']) || $user->admin == 1) {
            $dados['admin'] = true;
        } else {
            $dados['admin'] = false;
        }

        if(isset($dados['aprovado']) || $user->aprovado == 1) {
            $dados['aprovado'] = true;
        } else {
            $dados['aprovado'] = false;
        }

        if ($user->cpf != $dados['cpf']) {
            return redirect()->back()->withErrors(['cpf' => 'Você não pode alterar o cpf']);
        } else if($user->email != $dados['email']) {
            return redirect()->back()->withErrors(['email' => 'Você não pode alterar o email']);
        }
        
        $user->update($dados);
        
        return redirect()->route('admin.voluntarios')->with('success', 'Voluntário atualizado com sucesso!');
    }

    public function aprovarVoluntario($id)
    {
        $user = $this->user->find($id);

        if($user->aprovado) {
            $user->aprovado = false;
        } else {
            $user->aprovado = true;
        }

        $user->update();

        if($user->aprovado) {
            $user->notify(new VoluntarioAprovadoNotification());
        }

        return redirect()->route('admin.voluntarios')->with('success', 'Voluntário aprovado com sucesso!');
    }

    public function aprovarAdmin(Request $request) 
    {
        $dados = $request->all();

        $user = $this->user->where('email', $dados['email'])->latest()->first();

        $dados = [
            'admin' => true,
        ];

        if($user->admin) {
            $dados['admin'] = false;
        }

        $user->update($dados);

        if($user->admin) {
            $user->notify(new AdminAprovadoNotification());
            (new ForgotPasswordController())->sendResetLinkEmail($request);
        }

        return redirect()->route('admin.voluntarios')->with('success', 'Voluntário agora é administrador com sucesso!');
    }

    // Metodo da acao de apagar um projeto
    public function deletar($id) 
    {
        $user = $this->user->where('id', $id);

        if(Auth::user()->id == $id) {
            Auth::logout();
            $user->delete();
            return redirect()->route('site.home')->with('success', 'Conta excluída permanentemente!');
        } else if ($user->latest()->first()->admin) {
            return redirect()->route('admin.voluntarios')->with('error', 'Você não pode excluir outros administradores!');
        }
        
        $user->delete();
        return redirect()->route('admin.voluntarios')->with('success', 'Conta excluída permanentemente!');
        
    }

    public function voluntarios() 
    {
        $n_voluntarios = $this->user->whereNotNull('email_verified_at')
                                    ->where('aprovado', '=', 1)->count();

        return view('site.voluntarios.voluntarios', compact('n_voluntarios'));
    }

    public function voluntariosNorte() {
        $registros = $this->user
            ->whereNotNull('email_verified_at')
            ->where('aprovado', '=', 1)
            ->where(function($query) {
                $query->where('estado', '=', 'AC')
                    ->orWhere('estado', '=', 'AP')
                    ->orWhere('estado', '=', 'AM')
                    ->orWhere('estado', '=', 'PA')
                    ->orWhere('estado', '=', 'RR')
                    ->orWhere('estado', '=', 'RO')
                    ->orWhere('estado', '=', 'TO');
        })
        ->orderBy('name')->get();

        $estado = 'Norte';

        return view('site.voluntarios.regiao', compact('registros', 'estado'));
    }

    public function voluntariosNordeste() {
        $registros = $this->user
            ->whereNotNull('email_verified_at')
            ->where('aprovado', '=', 1)
            ->where(function($query) {
                $query->where('estado', '=', 'AL')
                    ->orWhere('estado', '=', 'BA')
                    ->orWhere('estado', '=', 'CE')
                    ->orWhere('estado', '=', 'PB')
                    ->orWhere('estado', '=', 'MA')
                    ->orWhere('estado', '=', 'PE')
                    ->orWhere('estado', '=', 'PI')
                    ->orWhere('estado', '=', 'RN')
                    ->orWhere('estado', '=', 'SE');
            })
            ->orderBy('name')->get();

        $estado = 'Nordeste';
        return view('site.voluntarios.regiao', compact('registros', 'estado'));
    }

    public function voluntariosCentro() {
        $registros = $this->user
            ->whereNotNull('email_verified_at')
            ->where('aprovado', 1)
            ->where(function($query) {
                $query->where('estado', '=', 'DF')
                    ->orWhere('estado', '=', 'GO')
                    ->orWhere('estado', '=', 'MT')
                    ->orWhere('estado', '=', 'MS');
        })
        ->orderBy('name')->get();

        $estado = 'Centro';

        return view('site.voluntarios.regiao', compact('registros', 'estado'));
    }

    public function voluntariosSudeste() {
        $registros = $this->user
            ->whereNotNull('email_verified_at')
            ->where('aprovado', 1)
            ->where(function($query) {
                $query->where('estado', '=', 'ES')
                    ->orWhere('estado', '=', 'MG')
                    ->orWhere('estado', '=', 'RJ')
                    ->orWhere('estado', '=', 'SP');
        })
        ->orderBy('name')->get();

        $estado = 'Sudeste';
        return view('site.voluntarios.regiao', compact('registros', 'estado'));
    }

    public function voluntariosSul() {
        $registros = $this->user
            ->whereNotNull('email_verified_at')
            ->where('aprovado', 1)
            ->where(function($query) {
                $query->where('estado', '=', 'PR')
                    ->orWhere('estado', '=', 'RS')
                    ->orWhere('estado', '=', 'SC');
        })
        ->orderBy('name')->get();

        $estado = 'Sul';

        return view('site.voluntarios.regiao', compact('registros', 'estado'));
    }
}
