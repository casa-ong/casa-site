<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContaPagamento;
use App\Models\Projeto;
use App\Models\Doacao;
use App\Http\Requests\DoacaoRequest;

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
        return view('admin.doacoes.adicionar');
    }

    public function salvar(DoacaoRequest $request) 
    {
        $request->validated();
        $dados = $request->all();

        $doacao = $this->doacao->create($dados);
        return redirect()->back()->with('success', 'Doação feita com sucesso!');
    
    }
}
