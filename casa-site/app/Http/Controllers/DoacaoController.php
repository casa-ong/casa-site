<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContaPagamento;
use App\Models\Projeto;
use App\Models\Doacao;
use App\Http\Requests\DoacaoRequest;
use App\Util\SaveFileUtil;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DoacaoController extends Controller
{
    protected $doacao;
    protected $contaPagamento;
    protected $projeto;


    public function __construct(Doacao $doacao, ContaPagamento $contaPagamento, Projeto $projeto)
    {
        $this->doacao = $doacao;
        $this->contaPagamento = $contaPagamento;
        $this->projeto = $projeto;
    }

    public function doacoes() 
    {
        $registros = $this->doacao->all()->reverse();
        return view('doacoes', compact('registros'));
    }

    public function index() {

        $registros = $this->doacao->all()->reverse();
        return view('admin.doacoes.index', compact('registros'));
    }

    public function adicionar() 
    {
        $contaPagamentos = $this->contaPagamento->latest('updated_at')->first();
        return view('admin.doacoes.adicionar', compact('contaPagamentos'));
    }

    public function salvar(DoacaoRequest $request) 
    {
        $request->validated();
        $dados = $request->all();
        $dados ['is_aprovado'] = 0;
        $doacao = $this->doacao->create($dados);

        if($request->hasFile('comprovante_anexo')) {
            $dados['comprovante_anexo'] = SaveFileUtil::saveFile(
                $request->file('comprovante_anexo'),
                $doacao->id,
                'img/doacao'
            );
        }

        $doacao->update($dados);

        return redirect()->back()->with('success', 'Doação feita com sucesso!');
    
    }
    // Método responsavel por ver a sugestao como lida 
    public function ver($id) 
    {
        $registro = $this->doacao->find($id);
        
        if($registro == null) {
            throw new ModelNotFoundException;
        }

        return view('admin.doacoes.ver', compact('registro'));
    }

    public function aprovar($id) 
    {
        $dados = [
            'is_aprovado' => 1
        ];

        $registro = $this->doacao->find($id);
        
        if($registro == null) {
            throw new ModelNotFoundException;
        }

        if($registro && $registro->is_aprovado){
            return redirect()->back()->withErrors(['doacaoIsAprovado' => 'Doação já foi aprovada.']);
        }

        $registro->update($dados);

        return redirect()->route('admin.doacoes')->with('success', 'Doação aprovada com sucesso!');
    }

}
