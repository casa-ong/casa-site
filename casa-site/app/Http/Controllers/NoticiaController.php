<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Noticia;
use App\Newsletter;
use Validator;
use App\Http\Requests\NoticiaRequest;
use App\Mail\NoticiaEmail;
use Mail;
use Notification;


class NoticiaController extends Controller
{

    protected $noticia;
    protected $newsletter;

    public function __construct(Noticia $noticia, Newsletter $newsletter) {
        $this->noticia = $noticia;
        $this->newsletter = $newsletter;
    }

    public function noticias() 
    {
        $noticias = $this->noticia->where('publicado', 1)->latest()->paginate(6);
        return view('site.noticias.noticias', compact('noticias'));
    }

    public function noticia($id) {
        $noticia = $this->noticia->where('id', $id)->where('publicado', true)->first();
        if(!$noticia) {
            throw new ModelNotFoundException;
        }

        return view('site.noticias.noticia', compact('noticia'));
    }
    
    // Metodo responsavel por abrir a pagina inicial das noticias
    public function index()
    {
        $registros = $this->noticia->all()->reverse();
        return view('admin.noticias.index', compact('registros'));
    }

    
    public function adicionar() 
    {
        return view('admin.noticias.adicionar');
    }

    // Método responsavel por salvar as informacoes do formulario de criacao no banco de dados
    public function salvar(NoticiaRequest $request) 
    {
        $request->validated();
        $dados = $request->all();
         
        if(isset($dados['publicado'])) {
            $dados['publicado'] = true;
        } else {
            $dados['publicado'] = false;
        }

        if(isset($dados['curtir'])) {
            $dados['curtir'] = true;
        } else {
            $dados['curtir'] = false;
        }

        if($request->hasFile('anexo')) {
            $anexo = $request->file('anexo');
            $num = rand(1111,9999);
            $dir = 'img/noticias';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'anexo_'.$num.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['anexo'] = $dir.'/'.$nomeAnexo;
        }

        $noticia = $this->noticia->create($dados);

        if($noticia->publicado) {
            $this->emailNoticia($noticia);
        }

        return redirect()->route('admin.noticias')->with('success', 'Notícia adicionada com sucesso!');
    }

    // Método responsavel por abrir a pagina de editar uma noticia
    public function editar($id) 
    {
        $registro = $this->noticia->find($id);
        return view('admin.noticias.editar', compact('registro'));
    }

    // Método responsavel por salvar as informacoes do formulario de edicao no banco de dados
    public function atualizar(NoticiaRequest $request, $id) 
    {
        $request->validated();
        $dados = $request->all();

        if(isset($dados['publicado'])) {
            $dados['publicado'] = true;
        } else {
            $dados['publicado'] = false;
        }

        if(isset($dados['curtir'])) {
            $dados['curtir'] = true;
        } else {
            $dados['curtir'] = false;
        }
       
        if($request->hasFile('anexo')) {
            $anexo = $request->file('anexo');
            $num = rand(1111,9999);
            $dir = 'img/noticias';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'anexo_'.$num.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['anexo'] = $dir.'/'.$nomeAnexo;
        }

        $noticia = $this->noticia->find($id);

        if(!$noticia->publicado && $dados['publicado'] == true) {
            $this->emailNoticia($noticia);
        }

        $noticia->update($dados);
        return redirect()->route('admin.noticias')->with('success', 'Notícia atualizada com sucesso!');
    }

    // Metodo da acao de apagar uma noticia
    public function deletar($id) 
    {
        $this->noticia->find($id)->delete();
        return redirect()->route('admin.noticias')->with('success', 'Notícia deletada com sucesso!');
    }

    public function emailNoticia($noticia) 
    {
        $newsletters = $this->newsletter
                        ->where('receber_noticias', true)->get();
        // Notification::send($newsletters, (new NovaNoticiaNotification($noticia)));

        $detalhes = [
            'url' => url('noticia/'.$noticia->id),
            'titulo' => $noticia->titulo,
            'texto' => $noticia->texto,
            'newsletter_id' => '',
        ];

        foreach ($newsletters as $newsletter) {
            $detalhes['newsletter_id'] = $newsletter->id;
            Mail::to($newsletter->getEmailAttribute())->send(new NoticiaEmail($detalhes));
        }
    }

}
