<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sugestao;
use App\User;
use Auth;
use Validator;
use App\Http\Requests\SugestaoRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Notifications\NovaSugestaoNotification;
use App\Notifications\SugestaoEnviadaNotification;
use App\Notifications\SugestaoLidaNotification;
use App\Notifications\VerifyEmailSugestaoNotification;
use \Illuminate\Notifications\Notifiable;
use Notification;

class SugestaoController extends Controller
{

    protected $user;
    protected $sugestao;

    public function __construct(User $user, Sugestao $sugestao)
    {
        $this->user = $user;
        $this->sugestao = $sugestao;
    }

    public function sugestoes() 
    {
        $registros = $this->sugestao->all()->reverse();
        return view('sugestoes', compact('registros'));
    }

    // Metodo responsavel por abrir a pagina de index das sugestoes
    public function index()
    {
        $registros = $this->sugestao->all()->reverse();
        return view('admin.sugestao.index', compact('registros'));
    }

    // Metodo que vai servir para adicionar uma sugestao que nao esta ligado ao admin
    public function adicionar() 
    {
        return view('adicionarSugestao');
    }
    
    // Método responsavel por salvar as informacoes do formulario de criacao no banco de dados
    public function salvar(SugestaoRequest $request) 
    {
        $request->validated();
        $dados = $request->all();

        if(isset($dados['lida'])) {
            $dados['lida'] = true;
        } else {
            $dados['lida'] = false;
        }

        $sugestao = $this->sugestao->create($dados);

        $sugestao->notify(new VerifyEmailSugestaoNotification($sugestao));

        if (Auth::user()) {
            return redirect()->route('admin.sugestoes')->with('success', 'Sugestão feita com sucesso! Verifique seu email para confirmar a solicitação.');
        } else {
            return redirect()->route('sugestao.adicionar')->with('success', 'Sugestão feita com sucesso! Verifique seu email para confirmar a solicitação.');
        }
    }

    // Método responsavel por ver a sugestao como lida 
    public function ver($id) 
    {
        $dados = [
            'lida' => true
        ];

        $registro = $this->sugestao->find($id);
        
        if($registro == null) {
            throw new ModelNotFoundException;
        }

        $registro->update($dados);

        return view('admin.sugestao.ver', compact('registro'));
    }

    // Método responsavel por salvar as informacoes do formulario de edicao no banco de dados
    public function atualizar($id) 
    {
      
        $dados = $this->sugestao->find($id);

        if($dados['lida']) {
            $this->sugestao->find($id)->update(['lida' => '0']);
        } else {
            $this->sugestao->find($id)->update(['lida' => '1']);
            $dados->notify(new SugestaoLidaNotification());
        }

        return redirect()->route('admin.sugestoes');
    }

    // Metodo da acao de apagar uma sugestao
    public function deletar($id) 
    {
        $this->sugestao->find($id)->delete();
        return redirect()->route('admin.sugestoes')->with('success', 'Sugestão deletada com sucesso!');
    }


}
