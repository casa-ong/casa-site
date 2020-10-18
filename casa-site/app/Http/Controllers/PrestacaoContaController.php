<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use App\Models\Doacao;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class PrestacaoContaController extends Controller
{
    protected $despesa;
    protected $doacao;
    public function __construct(Despesa $despesa, Doacao $doacao)
    {
        $this->despesa = $despesa;
        $this->doacao = $doacao;
    }

    public function index()
    {
        $totalArrecadado = $this->doacao->totalArrecadado();

        $registros = DB::select(DB::raw("SELECT id, nome, valor, created_at, 'despesa' as tipo
                                         FROM despesas
                                         UNION
                                         SELECT id, nome, valor, created_at, 'doacao' as tipo
                                         FROM doacaos
                                         ORDER BY created_at desc"
        ));

        $total = count($registros);
        $per_page = 10;
        $current_page = request()->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $registros = array_slice($registros, $starting_point, $per_page, true);
        
        $registros = 
            new LengthAwarePaginator($registros, $total, $per_page, $current_page,
                [
                    'path' => request()->url(),
                    'query' => request()->query(),
                ]
            );

        return view('site.prestacao_contas.index', compact('registros', 'totalArrecadado'));
    }

    public function ver($tipo, $id) 
    {
        if($tipo === 'doacao'){
            $registro = $this->doacao->find($id);
            if(!$registro) {
                throw new ModelNotFoundException;
            } 
            return response()
                ->view('site.prestacao_contas.prestacao_conta_doacao', compact('registro'), 200);       
        }else{
            $registro = $this->despesa->find($id);      
            if(!$registro) {
                throw new ModelNotFoundException;
            } 
            return response()
                ->view('site.prestacao_contas.prestacao_conta_despesa', compact('registro'), 200);   
        }       
    }
}
