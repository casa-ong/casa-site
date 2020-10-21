@extends('layout.site')
@section('titulo', 'Prestação de contas | Casa')

@php
    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
@endphp

@section('conteudo')

<div class="post">
    <div class="content main">
        <div class="item-title anchor" id="prestacaoContas">
            <h1>Prestação de contas</h1>
            <a class="btn btn-green" href="{{ route('doacao.adicionar') }}">Faça sua contribuição</a>
            @if(Session::has('success'))
            <div class="alert alert-success" onclick="$(this).toggle('hide')">
                <p>{{ Session::get('success') }}</p>
            </div>
            @endif
        </div>
        <div class="item-actions">
            <div class="filter-input row w-100">
                <div class="action d-flex align-center w-100">
                    <p class="m-0 mr-auto">Total de 
                        {!! $tipo != 'despesa' ? '<strong>R$ '.$totalArrecadado.'</strong> arrecadados' : '' !!}
                        {{ $tipo == 'all' ? ' e ' : ''}}
                        {!! $tipo != 'doacao' ? '<strong>R$ '.$totalGasto.'</strong> gastos' : '' !!}
                        {!! $initialDate ? 'no período de <strong>'.strftime('%d %b. %Y', strtotime($initialDate)).'</strong> a <strong>'.strftime('%d %b. %Y', strtotime($finalDate)).'</strong>' : '' !!}
                        {!! $initialDate || $tipo != 'all' ? '<a href="'.route('site.prestacao_contas').'#prestacaoContas">(Remover filtros)</a>' : '' !!}
                    </p>
                    <button class="btn btn-green action no-shrink" id="btnDateDropdown">
                        Filtrar por <span class="fas fa-caret-down"></span>
                    </button>
                    <div class="action-dropdown date" id="dateDropdown">
                        <form action="{{ route('site.prestacao_contas') }}" method="get" enctype="multipart/form-data">
                            <p><strong>Tipo de transação</strong></p>
                            <div class="border-b-1">
                                <input type="radio" value="all" id="all" name="tipo" {{ isset($tipo) && $tipo == 'all' ? 'checked' : '' }}>
                                <label for="all">Todos</label><br>
                                <input type="radio" value="doacao" id="doacao" name="tipo" {{ isset($tipo) && $tipo == 'doacao' ? 'checked' : '' }}>
                                <label for="doacao">Doações</label><br>
                                <input type="radio" value="despesa" id="despesa" name="tipo" {{ isset($tipo) && $tipo == 'despesa' ? 'checked' : '' }}>
                                <label for="despesa">Despesas</label>
                            </div>
                            <p><strong>Período</strong></p>
                            <label for="initial-date">Data inicial</label>
                            <input type="date" name="initial-date" id="initialDate" value="{{ $initialDate ?? '' }}">
                            <label for="final-date">Data final</label>
                            <input type="date" name="final-date" id="finalDate" value="{{ $finalDate ? (date('Y-m-d', strtotime($finalDate))) : '' }}">
                            <div class="text-center">
                                <button type="submit" class="btn btn-green mb-0" id="submitDates" {{-- href="#prestacaoContas" --}}>Filtrar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="table">
            <table>
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
                                            <a href="{{ route('site.prestacao_conta.ver', [$registro->tipo, $registro->id] ) }}">
                                                {{ $registro->nome ?? 'Anônimo' }}
                                                doou R$
                                                {{ $registro->valor }}
                                            </a>
                                        @else
                                        <a href="{{ route('site.prestacao_conta.ver', [$registro->tipo, $registro->id] ) }}">
                                                R$ {{ $registro->valor }}
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

@section('scripts')
    
    <script>

        let btnDateDropdown = document.getElementById('btnDateDropdown');

        let hideAndShowDatesDropdown = () => {
            let dateDropdown = document.getElementById('dateDropdown');
            dateDropdown.classList.toggle('show');
        };

        btnDateDropdown.addEventListener('click', hideAndShowDatesDropdown);

        window.addEventListener('load', () => {
            window.location.hash = 'prestacaoContas';
        })

    </script>

@endsection