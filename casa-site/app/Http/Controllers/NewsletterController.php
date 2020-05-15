<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Newsletter;
use Validator;
use App\Http\Requests\NewsletterRequest;

class NewsletterController extends Controller
{
    protected $newsletter;

    public function __construct(Newsletter $newsletter) {
        $this->newsletter = $newsletter;
    }


    public function index()
    {
        $registros = $this->newsletter->all()->reverse();
        return view('admin.newsletter.index', compact('registros'));

    }

    // Método responsavel por salvar as informacoes do formulario de criacao no banco de dados
    public function salvar(NewsletterRequest $request) 
    {
        $request->validated();
        $dados = $request->all();

        $dados['receber_eventos'] = true;
        $dados['receber_projetos'] = true;
        $dados['receber_noticias'] = true;

        
        $this->newsletter->create($dados);
        return redirect()->route('site.home')->with('success', 'Newsletter adicionada com sucesso!');

    }


    // Método responsavel por abrir a pagina de editar um projeto
    public function editar($id) 
    {
        $registro = $this->newsletter->find($id);
        return view('admin.newsletter.editar', compact('registro'));
    }

    // Método responsavel por salvar as informacoes do formulario de edicao no banco de dados
    public function atualizar(NewsletterRequest $request, $id) 
    {
        $request->validated();
        $dados = $request->all();

        
        if(isset($dados['receber_eventos'])) {
            $dados['receber_eventos'] = true;
        } else {
            $dados['receber_eventos'] = false;
        }

        if(isset($dados['receber_projetos'])) {
            $dados['receber_projetos'] = true;
        } else {
            $dados['receber_projetos'] = false;
        }

        if(isset($dados['receber_noticias'])) {
            $dados['receber_noticias'] = true;
        } else {
            $dados['receber_noticias'] = false;
        }
        
        $this->newsletter->find($id)->update($dados);
        return redirect()->route('admin.newsletters')->with('success', 'Newsletter atualizada com sucesso!');
    }

    // Metodo da acao de apagar uma newsletter
    public function deletar($id) 
    {
        $this->newsletter->find($id)->delete();
        return redirect()->route('admin.newsletters')->with('success', 'Newsletter deletada com sucesso!');
    }
}


