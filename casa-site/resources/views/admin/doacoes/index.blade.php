@extends('layout.site')
@section('titulo', 'Gerenciar doações | Casa')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1>Gerenciar doações</h1>
            <a class="btn btn-green" href="{{ route('doacao.adicionar') }}">Nova doação</a>
            @if(Session::has('success'))
            <div class="alert alert-success" onclick="$(this).toggle('hide')">
                <p>{{ Session::get('success') }}</p>
            </div>
            @endif
        </div>
        
        <div class="table">
            <table>
                <thead>
                    <tr class="table-header">
                        <th width="10%">Ações</th>
                        <th width="50%">Nome</th>
                        <th width="20%">Valor</th>
                        <th width="10%">Aprovada</th>
                        <th width="20%">Método de Pagamento</th>
                        
                    </tr>
                </thead>
                <tbody class="table-body">
                    @if(isset($registros) && count($registros) > 0)
                        @foreach ($registros as $registro)
                            <tr>
                                <td>
                                <a class="btn btn-green" href="{{ route("admin.doacao.ver",$registro->id) }}" title="Ver doação">
                                        <span class="fas fa-eye"></span>
                                    </a>
                                </td>
                                <td>{{ $registro->nome ?? 'Anônimo'}}</td>
                                <td>{{ $registro->valor }}</td>
                                <td>{{ $registro->is_aprovado ? 'Sim' : 'Não'}}</td>
                                <td>{{ $registro->meio_pagamento }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td height="56px" colspan="5">Ainda não há doações.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection