<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Enquete;
use App\Opcao;
use App\User;
use App\Http\Requests\EnqueteRequest;
use App\Http\Requests\VotarRequest;
use App\Util\SaveFileUtil;
use Auth;

class EnqueteController extends Controller
{
    protected $enquete;
    protected $opcao;
    protected $user;

    public function __construct(Enquete $enquete, Opcao $opcao, User $user)
    {
        $this->enquete = $enquete;
        $this->opcao = $opcao;
        $this->user = $user;
    }

    public function index() {
        $registros = $this->enquete;

        $filtro['nome'] = 'Todos';

        if(request()->has('is_aberta') && request('is_aberta') != '') {
            $registros = $registros->where('is_aberta', request('is_aberta'));
            $filtro['is_aberta'] = request('is_aberta');
            $filtro['nome'] = (request('is_aberta') ? 'Abertas' : 'Encerradas');
        }

        $registros = $registros->latest()->get();

        return view('admin.enquetes.index', compact('registros', 'filtro'));
    }

    public function ver($id)
    {
        $registro = $this->enquete->find($id);

        if(!$registro->is_aberta && Auth::guest()) {
            return view('errors.404_enquete');
        }

        return view('site.enquetes.enquete', compact('registro'));
    }

    public function votar(VotarRequest $request, $id)
    {
        $request->validated();
        
        $dados = $request->all();
        $opcao = $this->opcao->find($dados['opcao']);
        
        if(!$opcao->is_aberta) {
            return view('errors.404_enquete');
        }

        $opcao->votos++;
        $opcao->update();

        return redirect()->back()->with('success', 'Voto registrado com sucesso!');
    }

    public function adicionar()
    {
        return view('admin.enquetes.adicionar');
    }

    public function salvar(EnqueteRequest $request)
    {
        $request->validated();
        $dados = $request->all();

        if(isset($dados['publicar'])) {
            $dados['is_aberta'] = true;
        } else if(isset($dados['rascunho'])) {
            $dados['is_aberta'] = false;
        }
        
        $enquete = $this->enquete->create($dados);
        
        for($i = 0; $i < count($dados['opcao']); $i++) {

            $opcao = [
                'nome' => $dados['opcao'][$i],
                'foto' => $dados['foto'][$i] ?? null,
                'enquete_id' => $enquete->id,
            ];
            
            $opcaoSalva = $this->opcao->create($opcao);

            if(isset($request->file('foto')[$i])) {
                $opcao['foto'] = SaveFileUtil::saveFile($request->file('foto')[$i], $opcaoSalva->id, 'img/opcaos');
                $opcaoSalva->update($opcao);
            }
        }


        return redirect()->route('admin.enquetes')->with('success', 'Enquete criada com sucesso!');
    }

    public function atualizar($id)
    {
        $dados = $this->enquete->find($id);

        $status = "aberta";

        if($dados['is_aberta']) {
            $dados->update(['is_aberta' => '0']);
            $status = "fechada";
        } else {
            $dados->update(['is_aberta' => '1']);
        }

        return redirect()->back()->with('success', 'Status da enquete alterado para '.$status);
    }

    public function deletar($id) 
    {
        $this->enquete->find($id)->delete();
        return redirect()->back()->with('success', 'Enquete deletada com sucesso!');
    }

    public function deletarOpcao($id) 
    {
        $this->opcao->find($id)->delete();
        return redirect()->back()->with('success', 'Opção removida com sucesso!');
    }
}
