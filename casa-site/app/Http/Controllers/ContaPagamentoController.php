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

    public function sobre() 
    {
        $registro = $this->contaPagamento->latest('updated_at')->first();
        return view('contaPagamento', compact('registro'));
    }

    public function adicionar() 
    {
        return view('admin.contaPagamento.adicionar');
    }

    public function salvar(SobreRequest $request) 
    {

        $request->validated();
        $dados = $request->all();

        $contaPagamento = $this->contaPagamento->create($dados);
        
        $dados['contaPagamento_id'] = $contaPagamento->id;
        
        $contaPagamento->update($dados);

        return redirect()->route('admin.contaPagamento')->with('success', 'Informações adicionadas com sucesso!');
    }

     // Método responsavel por abrir a pagina de editar um evento
     public function editar($id) 
     {
         $registro = $this->contaPagamento->find($id);
         return view('admin.contaPagamento.editar', compact('registro'));
     }
 
     // Método responsavel por salvar as informacoes do formulario de edicao no banco de dados
     public function atualizar(SobreRequest $request, $id) 
     {
         $request->validated();
         $dados = $request->all();
         
         $dadosOld = $this->contaPagamento->find($id);
 
         $dados['contaPagamento_id'] = $dadosOld->id;
 
         $dadosOld->touch();
         $dadosOld->update($dados);
 
         return redirect()->back()->with('success', 'Informações atualizadas com sucesso!');
     }
}
