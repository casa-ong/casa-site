<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Evento;
use App\Newsletter;
use Validator;
use App\Http\Requests\EventoRequest;
use App\Mail\EventoEmail;
use Mail;

class EventoController extends Controller
{

    protected $evento;
    protected $newsletter;

    public function __construct(Evento $evento, Newsletter $newsletter) 
    {
        $this->evento = $evento;
        $this->newsletter = $newsletter;

        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    }

    public function eventos() 
    {
        $eventos = $this->evento->where('publicado', 1)->latest()->paginate(4);
        return view('site.eventos.eventos', compact('eventos'));
    }

    public function evento($id) {
        $evento = $this->evento->find($id);
        if(!$evento) {
            throw new ModelNotFoundException;
        }
        return view('site.eventos.evento', compact('evento'));
    }

    // Metodo responsavel por abrir a pagina de index dos eventos
    public function index()
    {
        $registros = $this->evento->all()->reverse();
        return view('admin.eventos.index', compact('registros'));
    }

    // Metodo que vai servir para adiconar o evento
    public function adicionar() 
    {
        return view('admin.eventos.adicionar');
    }
    
    // Método responsavel por salvar as informacoes do formulario de criacao no banco de dados
    public function salvar(EventoRequest $request) 
    {
        $request->validated();
        $dados = $request->all();
        
        if(isset($dados['publicado'])) {
            $dados['publicado'] = true;
        } else {
            $dados['publicado'] = false;
        }

        if($request->hasFile('anexo')) {
            $anexo = $request->file('anexo');
            $num = rand(1111,9999);
            $dir = 'img/eventos';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'anexo_'.$num.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['anexo'] = $dir.'/'.$nomeAnexo;
        }

        $evento = $this->evento->create($dados);

        if($evento->publicado) {
            $this->emailEvento($evento);
        }

        return redirect()->route('admin.eventos')->with('success', 'Evento adicionado com sucesso!');
    }

    // Método responsavel por abrir a pagina de editar um evento
    public function editar($id) 
    {
        $registro = $this->evento->find($id);
        return view('admin.eventos.editar', compact('registro'));
    }

    // Método responsavel por salvar as informacoes do formulario de edicao no banco de dados
    public function atualizar(EventoRequest $request, $id) 
    {
        $request->validated();
        $dados = $request->all();
        
        if(isset($dados['publicado'])) {
            $dados['publicado'] = true;
        } else {
            $dados['publicado'] = false;
        }

        if($request->hasFile('anexo')) {
            $anexo = $request->file('anexo');
            $num = rand(1111,9999);
            $dir = 'img/eventos';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'anexo_'.$num.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['anexo'] = $dir.'/'.$nomeAnexo;
        }

        $evento = $this->evento->find($id);

        if(!$evento->publicado && $dados['publicado'] == true) {
            $this->emailEvento($evento);
        }

        $evento->update($dados);

        return redirect()->route('admin.eventos')->with('success', 'Evento atualizado com sucesso!');
    }

    // Metodo da acao de apagar um evento
    public function deletar($id) 
    {
        $this->evento->find($id)->delete();
        return redirect()->route('admin.eventos')->with('success', 'Evento deletado com sucesso!');
    }

    public function emailEvento($evento) 
    {
        $newsletters = $this->newsletter
                        ->where('receber_eventos', true)->get();

        $detalhes = [
            'url' => url('evento/'.$evento->id),
            'titulo' => $evento->nome,
            'texto' => 'O evento acontecerá no dia '.date('d/m/Y', strtotime($evento->data)).' às '.date('H:i', strtotime($evento->data)),
            'info' => 'Para ver mais detalhes do evento clique no link abaixo',
            'newsletter_id' => '',
            'newsletter_token' => ''
        ];

        foreach ($newsletters as $newsletter) {
            $detalhes['newsletter_id'] = $newsletter->id;
            $detalhes['newsletter_token'] = $newsletter->token;
            Mail::to($newsletter->getEmailAttribute())->send(new EventoEmail($detalhes));
        }
    }

}
