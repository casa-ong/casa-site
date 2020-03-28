<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sugestao;

class SugestaoController extends Controller
{
    public function sugestoes() 
    {
        $registros = Sugestao::all()->reverse();
        return view('sugestoes', compact('registros'));
    }

    // Metodo responsavel por abrir a pagina de index das sugestoes
    public function index()
    {
        $registros = Sugestao::all();
        return view('admin.sugestao.index', compact('registros'));
    }

    // Metodo que vai servir para adiconar uma sugestao que nao esta ligado ao admin
    public function adicionar() 
    {
        return view('adicionarSugestao');
    }
    
    // Método responsavel por salvar as informacoes do formulario de criacao no banco de dados
    public function salvar(Request $request) 
    {
        $dados = $request->all();
        Sugestao::create($dados);

        return redirect()->route('admin.sugestoes');
    }

    // Método responsavel por abrir a pagina de editar uma sugestao
    public function editar($id) 
    {
        $registro = Sugestao::find($id);
        return view('admin.sugestao.editar', compact('registro'));
    }

    // Método responsavel por salvar as informacoes do formulario de edicao no banco de dados
    public function atualizar(Request $request, $id) 
    {
        $dados = $request->all();
        Sugestao::find($id)->update($dados);

        return redirect()->route('admin.sugestoes');
    }

    // Metodo da acao de apagar um evento
    public function deletar($id) 
    {
        Sugestao::find($id)->delete();
        return redirect()->route('admin.sugestoes');
    }


}
