<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Publicacao;
use App\Models\Newsletter;
use App\Models\Projeto;
use App\Http\Requests\PublicacaoRequest;
use App\Util\SaveFileUtil;

class PublicacaoController extends Controller
{

    protected $publicacao;
    protected $newsletter;
    protected $projeto;

    public function __construct(Publicacao $publicacao, Newsletter $newsletter, Projeto $projeto) 
    {
        $this->publicacao = $publicacao;
        $this->newsletter = $newsletter;
        $this->projeto = $projeto;

        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    }

    public function publicacaos() 
    {
        $registros = $this->publicacao->where('publicado', 1);

        $tipo = 'evento';
        if(request()->route()->named('site.noticias')) {
            $tipo = 'noticia';
            $registros = $registros->where('tipo', 'noticia')->latest()->paginate(4);
            return view('site.publicacaos.publicacaos', compact('tipo','registros'));
        }
        $registros = $registros->where('tipo', 'evento')->latest()->paginate(4);
        return view('site.publicacaos.publicacaos', compact('tipo', 'registros'));
    }

    public function publicacao($id) {
        $noticias = $this->publicacao
                ->where('publicado', 1)
                ->where('tipo', 'noticia')
                ->latest()->take(3)->get()->except($id);

        $projetos = $this->projeto->where('publicado', 1)->latest()->take(2)->get();

        $registro = $this->publicacao->find($id);
        if(!$registro) {
            throw new ModelNotFoundException;
        }
        return view('site.publicacaos.publicacao', compact('registro', 'noticias', 'projetos'));
    }

    // Metodo responsavel por abrir a pagina de index dos eventos
    public function index()
    {
        $registros = $this->publicacao;
        $filtro['nome'] = 'Todos';

        if(request()->has('publicado') && request('publicado') != '') {
            $registros = $registros->where('publicado', request('publicado'));
            $filtro['publicado'] = request('publicado'); 
            $filtro['nome'] = request('publicado') ? 'Public.' : 'Rasc.';
        }
        
        if(request()->route()->named('admin.noticias')) {
            $registros = $registros->where('tipo', 'noticia')->latest()->get();
            return view('admin.noticias.index', compact('registros', 'filtro'));
        }

        $registros = $registros->where('tipo', 'evento')->latest()->get();
        return view('admin.eventos.index', compact('registros', 'filtro'));
    }

    // Metodo que vai servir para adiconar o evento
    public function adicionar() 
    {
        if(request()->route()->named('admin.noticia.adicionar')) {
            return view('admin.noticias.adicionar');
        }
        return view('admin.eventos.adicionar');
    }
    
    // Método responsavel por salvar as informacoes do formulario de criacao no banco de dados
    public function salvar(PublicacaoRequest $request) 
    {
        $request->validated();
        $dados = $request->all();
        
        if(isset($dados['publicar'])) {
            $dados['publicado'] = true;
        } else if(isset($dados['rascunho'])) {
            $dados['publicado'] = false;
        }

        
        $publicacao = $this->publicacao->create($dados);
        
        if($request->hasFile('anexo')) {
            $dados['anexo'] = SaveFileUtil::saveFile(
                $request->file('anexo'),
                $publicacao->id,
                'img/'.($publicacao->tipo == 'evento' ? 'eventos' : 'noticias')
            );
        }

        $publicacao->update($dados);

        if($publicacao->publicado) 
        {
            if($publicacao->tipo == 'evento') 
            {
                $newsletters = $this->newsletter->where('receber_eventos', true)->get();
                $this->publicacao->emailEvento($publicacao, $newsletters);
            }
            else if($publicacao->tipo == 'noticia')
            {
                $newsletters = $this->newsletter->where('receber_noticias', true)->get();
                $this->publicacao->emailNoticia($publicacao, $newsletters);
            }
        }

        return redirect()->route(
                    'admin.'.($publicacao->tipo == 'evento' ? 'eventos' : 'noticias')
                )->with('success', 'Publicação adicionada com sucesso!');
    }

    // Método responsavel por abrir a pagina de editar um evento
    public function editar($id) 
    {
        $registro = $this->publicacao->find($id);
        
        return view(
            'admin.'.($registro->tipo == 'evento' ? 'eventos' : 'noticias').'.editar',
            compact('registro')
        );
    }

    // Método responsavel por salvar as informacoes do formulario de edicao no banco de dados
    public function atualizar(PublicacaoRequest $request, $id) 
    {
        $request->validated();
        $dados = $request->all();
        
        if(isset($dados['publicar'])) {
            $dados['publicado'] = true;
        } else if($dados['rascunho']) {
            $dados['publicado'] = false;
        }

        
        $publicacao = $this->publicacao->find($id);
        
        if($request->hasFile('anexo')) {
            $dados['anexo'] = SaveFileUtil::saveFile(
                $request->file('anexo'),
                $publicacao->id,
                'img/'.($publicacao->tipo == 'evento' ? 'eventos' : 'noticias')
            );
        }

        if(!$publicacao->publicado && $dados['publicado'] == true) 
        {
            if($publicacao->tipo == 'evento') 
            {
                $newsletters = $this->newsletter->where('receber_eventos', true)->get();
                $this->publicacao->emailEvento($publicacao, $newsletters);
            }
            else if($publicacao->tipo == 'noticia')
            {
                $newsletters = $this->newsletter->where('receber_noticias', true)->get();
                $this->publicacao->emailNoticia($publicacao, $newsletters);
            }
        }

        $publicacao->update($dados);

        return redirect()->route(
            'admin.'.($publicacao->tipo == 'evento' ? 'eventos' : 'noticias')
        )->with('success', 'Publicação atualizada com sucesso!');
    }

    // Metodo da acao de apagar um evento
    public function deletar($id) 
    {
        $this->publicacao->find($id)->delete();
        return redirect()->back()->with('success', 'Publicação deletada com sucesso!');
    }

}
