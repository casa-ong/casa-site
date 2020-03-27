<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DadosSite;
 
class DadosSiteController extends Controller
{
    public function index() 
    {
        $registros = DadosSite::all()->reverse();
        return view('admin.dados_site.index', compact('registros'));
    }

    public function adicionar() 
    {
        return view('admin.dados_site.adicionar');
    }
    
    // Método responsavel por salvar as informacoes do formulario de criacao no banco de dados
    public function salvar(Request $request) 
    {
        $dados = $request->all();
    
        if($request->hasFile('logo')) {
            $anexo = $request->file('logo');
            $num = rand(1111,9999);
            $dir = 'img/logos';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'logo_'.$num.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['logo'] = $dir.'/'.$nomeAnexo;
        }

        if($request->hasFile('banner')) {
            $anexo = $request->file('banner');
            $num = rand(1111,9999);
            $dir = 'img/banner';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'banner_'.$num.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['banner'] = $dir.'/'.$nomeAnexo;
        }

        DadosSite::create($dados);

        return redirect()->route('admin.dados_site');
    }

    // Método responsavel por abrir a pagina de editar um evento
    public function editar($id) 
    {
        $registro = DadosSite::find($id);
        return view('admin.dados_site.editar', compact('registro'));
    }

    // Método responsavel por salvar as informacoes do formulario de edicao no banco de dados
    public function atualizar(Request $request, $id) 
    {
        $dados = $request->all();
        if($request->hasFile('logo')) {
            $anexo = $request->file('logo');
            $num = rand(1111,9999);
            $dir = 'img/logos';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'logo_'.$num.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['logo'] = $dir.'/'.$nomeAnexo;
        }

        if($request->hasFile('banner')) {
            $anexo = $request->file('banner');
            $num = rand(1111,9999);
            $dir = 'img/banner';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'banner_'.$num.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['banner'] = $dir.'/'.$nomeAnexo;
        }

        $dadoSite = DadosSite::find($id);
        $dadoSite->touch();
        $dadoSite->update($dados);

        return redirect()->route('admin.dados_site');
    }
}
