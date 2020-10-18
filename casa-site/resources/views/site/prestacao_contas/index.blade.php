@extends('layout.site')
@section('titulo', 'Prestação de contas | Casa')

@php
    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
@endphp

@section('conteudo')

<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1>Prestação de contas</h1>
        </div>
        <div class="title" style="text-align: center;">
            <p>Total de 
                <br><strong>R$ {{ $totalArrecadado }}</strong>
                <br> arrecadados
            </p>
        </div>
        <div class="item-title">
            <a class="btn btn-green" href="{{ route('doacao.adicionar') }}">Faça sua contribuição</a>
            @if(Session::has('success'))
            <div class="alert alert-success" onclick="$(this).toggle('hide')">
                <p>{{ Session::get('success') }}</p>
            </div>
            @endif
        </div>
        
        <div class="table">
            <table>
                {{-- <thead>
                    <tr class="table-header">
                        <th width="20%">Ações</th>
                        <th width="40%">Nome</th>
                        <th width="20%">Valor</th>
                        <th width="20%">Método de Pagamento</th>
                    </tr>
                </thead> --}}
                <tbody class="table-body">
                    @if(isset($registros) && count($registros) > 0)
                        @foreach ($registros as $registro)
                            <tr>
                                <td width="5%">
                                    @if ($registro->tipo == 'doacao')
                                        <span class="fas fa-sign-in-alt"></span>
                                    @else
                                        <span class="fas fa-sign-out-alt"></span>
                                    @endif
                                </td>
                                <td style="text-align: left;">
                                        @if ($registro->tipo == 'doacao')
                                            <a href="#">
                                                {{ $registro->nome }}
                                                doou R$
                                                {{ $registro->valor }}
                                            </a>
                                        @else
                                            <a href="#">
                                                {{ $registro->valor }}
                                                <span style="text-transform: lowercase;">
                                                    {{ $registro->nome }}
                                                </span>
                                            </a>
                                        @endif
                                </td>
                                <td width="15%">{{ strftime('%d %b. %Y', strtotime($registro->created_at)) }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td height="56px" colspan="3">Ainda não há doações ou despesas.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        @if(isset($registros) && count($registros) > 0)
            <div class="content-footer">
                <div class="page-nav">
                    {{ $registros->links() }}
                </div>
            </div>    
        @endif
    </div>
</div>

@endsection