<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use App\Http\Requests\DespesaRequest;


class DespesaController extends Controller
{
    protected $despesa;
    public function __construct(Despesa $despesa)
    {
        $this->despesa = $despesa;
    }
    // Metodo responsavel por abrir a pagina inicial dos projetos
    public function index()
    {

        $registros = $this->despesa;

        $registros = $registros->latest()->get();
        return view('admin.despesas.index', compact('registros'));
    }

    public function adicionar()
    {
        return view('admin.despesas.adicionar');
    }

    // Método responsavel por salvar as informacoes do formulario de criacao no banco de dados
    public function salvar(DespesaRequest $request)
    {
        $request->validated();
        $dados = $request->all();

        $despesa = $this->despesa->create($dados);

        if ($request->hasFile('nota_fiscal')) {
            $anexo = $request->file('nota_fiscal');
            $num = $despesa->id;
            $dir = 'img/despesas';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'nota_fiscal_' . $num . '.' . $ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['nota_fiscal'] = $dir . '/' . $nomeAnexo;
        }

        $despesa->update($dados);

        return redirect()->route('admin.despesas')->with('success', 'Despesa adicionada com sucesso!');
    }

    // Método responsavel por abrir a pagina de editar um projeto
    public function editar($id)
    {
        $registro = $this->despesa->find($id);
        return view('admin.despesas.editar', compact('registro'));
    }

    // Método responsavel por salvar as informacoes do formulario de edicao no banco de dados
    public function atualizar(DespesaRequest $request, $id)
    {
        $request->validated();
        $dados = $request->all();

        $despesa = $this->despesa->find($id);
        
        if ($request->hasFile('nota_fiscal')) {
            $anexo = $request->file('nota_fiscal');
            $num = $despesa->id;
            $dir = 'img/despesas';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'nota_fiscal_' . $num . '.' . $ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['nota_fiscal'] = $dir . '/' . $nomeAnexo;
        }

        $despesa->update($dados);

        return redirect()->route('admin.despesas')->with('success', 'Despesa atualizada com sucesso!');
    }

    // Metodo da acao de apagar um projeto
    public function deletar($id)
    {
        $this->despesa->find($id)->delete();
        return redirect()->route('admin.despesas')->with('success', 'Despesa deletada com sucesso!');
    }
}
