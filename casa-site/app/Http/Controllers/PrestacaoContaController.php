<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Despesa;
use App\Models\Doacao;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class PrestacaoContaController extends Controller
{
    protected $despesa;
    protected $doacao;
    public function __construct(Despesa $despesa, Doacao $doacao)
    {
        $this->despesa = $despesa;
        $this->doacao = $doacao;
    }

    public function index(Request $request)
    {
        $filtros = $request->all();
        $initialDate = isset($filtros['initial-date']) ? $filtros['initial-date'] : null;
        $finalDate = isset($filtros['final-date']) ? $filtros['final-date'] : null;
        $tipo = isset($filtros['tipo']) ? $filtros['tipo'] : 'all';

        $select = "SELECT * FROM (
                    SELECT id, nome, valor, user_id, created_at, 'despesa' AS tipo
                    FROM despesas
                    UNION
                    SELECT id, nome, valor, '' AS user_id, created_at, 'doacao' AS tipo
                    FROM doacaos
                    ORDER BY created_at desc
                  ) AS query";

        if($initialDate) {
            if(!$finalDate) {
                $finalDate = now();
            }

            $select = $select." WHERE created_at >= '".$initialDate."' AND created_at <= '".$finalDate."'";
        }
        
        if($tipo && $tipo != 'all' && ($tipo == 'doacao' || $tipo == 'despesa')) {
            if($initialDate) {
                $select = $select." AND tipo = '".$tipo."'";
            } else {
                $select = $select." WHERE tipo = '".$tipo."'";
            }
        }

        $totalArrecadado = 0;
        $totalGasto = 0;

        $registros = DB::select(DB::raw($select));

        foreach($registros as $registro) {
            if($registro->tipo == 'doacao') {
                $totalArrecadado += $registro->valor;
            } else {
                $totalGasto += $registro->valor;
            }
        }

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

        return view('site.prestacao_contas.index', compact('registros', 'totalArrecadado', 'totalGasto', 'tipo', 'initialDate', 'finalDate'));
    }
}
