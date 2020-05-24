<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Newsletter;
use Validator;
use App\Http\Requests\NewsletterRequest;
use App\Notifications\NewsletterAdicionadaNotification;

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
        
        $newsletter = $this->newsletter->create($dados);

        $newsletter->notify(new NewsletterAdicionadaNotification($newsletter));

        return redirect()->back()->with('newsletter', 'Cadastro feito com sucesso, agora você ficará sabendo das novidades!');

    }


    // Método responsavel por abrir a pagina de editar um projeto
    public function editar($id) 
    {
        $registro = $this->newsletter->find($id);
        return view('admin.newsletter.editar', compact('registro'));
    }

    // Método responsavel por salvar as informacoes do formulario de edicao no banco de dados
    public function atualizar(Request $request,$id) 
    {
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
        
        if(!$dados['receber_eventos'] && !$dados['receber_projetos'] && !$dados['receber_noticias']) {
            $this->newsletter->find($id)->delete();
            return redirect()->back()->with('success', 'Notificações de email canceladas com sucesso!');
        }

        return redirect()->back()->with('success', 'Notificações de email atualizadas com sucesso!');
    }

    // Metodo da acao de apagar uma newsletter
    public function deletar($id) 
    {
        $this->newsletter->find($id)->delete();
        return redirect()->back()->with('success', 'Feito! Você não receberá mais novos email.');
    }
}

