<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContaPagamento;
use Validator;
use App\Http\Requests\ContaPagamentoRequest;

class ContaPagamentoController extends Controller
{
    
    protected $contaPagamento;
    
    public function __construct(ContaPagamento $contaPagamento)
    {
        $this->contaPagamento = $contaPagamento;
    } 

    public function index() 
    {
        $registro = $this->contaPagamento->latest('updated_at')->first();
        if(!isset($registro)) {
            return view('admin.conta_pagamentos.adicionar');
        }
        return view('admin.conta_pagamentos.editar', compact('registro'));
    }

    public function conta_pagamento() 
    {
        $registro = $this->contaPagamento->latest('updated_at')->first();
        return view('conta_pagamentos', compact('registro'));
    }

    public function adicionar() 
    {
        return view('admin.conta_pagamentos.adicionar');
    }

    public function salvar(ContaPagamentoRequest $request) 
    {

        $request->validated();
        $dados = $request->all();

        $contaPagamento = $this->contaPagamento->create($dados);
        
        $dados['contaPagamento_id'] = $contaPagamento->id;
        
        $contaPagamento->update($dados);

        return redirect()->route('admin.conta_pagamentos')->with('success', 'Informações adicionadas com sucesso!');
    }

     // Método responsavel por abrir a pagina de editar um evento
     public function editar($id) 
     {
         $registro= $this->contaPagamento->find($id);
         return view('admin.conta_pagamentos.editar', compact('registro'));
     }
 
     // Método responsavel por salvar as informacoes do formulario de edicao no banco de dados
     public function atualizar(ContapagamentoRequest $request, $id) 
     {
         $request->validated();
         $dados = $request->all();
         
         $dadosOld = $this->contaPagamento->find($id);
 
         $dados['contaPagamento_id'] = $dadosOld->id;
 
         $dadosOld->touch();
         $dadosOld->update($dados);
 
         return redirect()->route('admin.conta_pagamentos')->with('success', 'Informações atualizadas com sucesso!');
     }
}
