<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sobre;
use App\Models\Contato;
use Validator;
use App\Http\Requests\SobreRequest;
 
class SobreController extends Controller
{

    protected $sobre;
    protected $contato;

    public function __construct(Sobre $sobre, Contato $contato)
    {
        $this->sobre = $sobre;
        $this->contato = $contato;
    } 

    public function sobre() 
    {
        $registro = $this->sobre->latest('updated_at')->first();
        $contato = $this->contato->where('sobre_id', $registro->id);
        return view('sobre', compact('registro', 'contato'));
    }

    public function index() 
    {
        $registro = $this->sobre->latest('updated_at')->first();
        if(!isset($registro)) {
            return view('admin.sobre.adicionar');
        }
        $contato = $this->contato->where('sobre_id', $registro->id)->first();

        return view('admin.sobre.editar', compact('registro', 'contato'));
    }

    public function adicionar() 
    {
        return view('admin.sobre.adicionar');
    }
    
    // Método responsavel por salvar as informacoes do formulario de criacao no banco de dados
    public function salvar(SobreRequest $request) 
    {

        $request->validated();
        $dados = $request->all();

        $sobre = $this->sobre->create($dados);
        
        if($request->hasFile('logo')) {
            $anexo = $request->file('logo');
            $num = $sobre->id;
            $dir = 'img/logos';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'logo_'.$num.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['logo'] = $dir.'/'.$nomeAnexo;
        }

        if($request->hasFile('banner')) {
            $anexo = $request->file('banner');
            $num = $sobre->id;
            $dir = 'img/banner';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'banner_'.$num.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['banner'] = $dir.'/'.$nomeAnexo;
        }

        $dados['sobre_id'] = $sobre->id;
        $contato = $this->contato->create($dados);

        $sobre->update($dados);

        return redirect()->route('admin.sobre')->with('success', 'Informações adicionadas com sucesso!');
    }

    // Método responsavel por abrir a pagina de editar um evento
    public function editar($id) 
    {
        $registro = $this->sobre->find($id);
        return view('admin.sobre.editar', compact('registro'));
    }

    // Método responsavel por salvar as informacoes do formulario de edicao no banco de dados
    public function atualizar(SobreRequest $request, $id) 
    {
        $request->validated();
        $dados = $request->all();
        
        $dadoSite = $this->sobre->find($id);

        if($request->hasFile('logo')) {
            $anexo = $request->file('logo');
            $num = $dadoSite->id;
            $dir = 'img/logos';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'logo_'.$num.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['logo'] = $dir.'/'.$nomeAnexo;
        }

        if($request->hasFile('banner')) {
            $anexo = $request->file('banner');
            $num = $dadoSite->id;
            $dir = 'img/banner';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'banner_'.$num.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['banner'] = $dir.'/'.$nomeAnexo;
        }

        $dados['sobre_id'] = $dadoSite->id;
        $contato = $this->contato->where('sobre_id', $dadoSite->id)->first();
        $contato->update($dados);

        $dadoSite->touch();
        $dadoSite->update($dados);

        return redirect()->back()->with('success', 'Informações atualizadas com sucesso!');
    }
}
