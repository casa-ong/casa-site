<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sobre;
use Validator;
 
class SobreController extends Controller
{

    protected $sobre;

    public function __construct(Sobre $sobre)
    {
        $this->sobre = $sobre;
    } 

    public function sobre() 
    {
        $registro = $this->sobre->latest('updated_at')->first();
        return view('sobre', compact('registro'));
    }

    public function index() 
    {
        $registro = $this->sobre->latest('updated_at')->first();
        // $registros = $this->sobre->all()->reverse();
        if(!isset($registro)) {
            return view('admin.sobre.adicionar');
        }

        return view('admin.sobre.editar', compact('registro'));
    }

    public function adicionar() 
    {
        return view('admin.sobre.adicionar');
    }
    
    // Método responsavel por salvar as informacoes do formulario de criacao no banco de dados
    public function salvar(Request $request) 
    {
        $dados = $request->all();

        // Validar campos ao salvar
        $validarDados = Validator::make($dados, 
                                    $this->sobre::$rules,
                                    $this->sobre::$messages);

        if($validarDados->fails()) {
            return redirect()->back()->withErrors($validarDados->errors())->withInput();
        }
    
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

        if($request->hasFile('anexo_sobre')) {
            $anexo = $request->file('anexo_sobre');
            $num = rand(1111,9999);
            $dir = 'img/anexo_sobre';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'anexo_sobre_'.$num.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['anexo_sobre'] = $dir.'/'.$nomeAnexo;
        }

        $this->sobre->create($dados);

        return redirect()->route('admin.sobre');
    }

    // Método responsavel por abrir a pagina de editar um evento
    public function editar($id) 
    {
        $registro = $this->sobre->find($id);
        return view('admin.sobre.editar', compact('registro'));
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

        if($request->hasFile('anexo_sobre')) {
            $anexo = $request->file('anexo_sobre');
            $num = rand(1111,9999);
            $dir = 'img/anexo_sobre';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'anexo_sobre_'.$num.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['anexo_sobre'] = $dir.'/'.$nomeAnexo;
        }

        $dadoSite = $this->sobre->find($id);
        $dadoSite->touch();
        $dadoSite->update($dados);

        return redirect()->route('admin.index');
    }
}
