@extends('layout.site')
@section('titulo', 'Gerenciar enquetes | Casa')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1>Gerenciar enquetes</h1>
            <a class="btn btn-green" href="{{ route('admin.enquete.adicionar') }}">Nova enquete</a>
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
                        <th width="20%">Ações</th>
                        <th width="30%">Texto</th>
                        <th width="20%">Votos</th>
                        <th width="25%">
                            <label for="dropdown" class="btn-dropdown">
                                Status&nbsp;({{ $filtro['nome'] ?? 'Todos' }})
                                <i class="fas fa-caret-down"></i>
                                <input type="checkbox" class="dropdown" id="dropdown">
                                <div id="dropdown-links" class="dropdown-links">
                                    @if(isset($filtro))
                                        {!! $filtro['nome'] != 'Todos' ? '<a href="'.route('admin.enquetes').'">Todos</a>' : '' !!}
                                        {!! $filtro['nome'] != 'Abertas' ? '<a href="'.route('admin.enquetes').'?is_aberta=1">Abertas</a>' : '' !!}
                                        {!! $filtro['nome'] != 'Encerradas' ? '<a href="'.route('admin.enquetes').'?is_aberta=0">Encerradas</a>' : '' !!}
                                    @endif
                                </div>
                            </label>
                        </th>
                    </tr>
                </thead>
                <tbody class="table-body">

                    @if(isset($registros) && count($registros) > 0)
                        @foreach ($registros as $registro)
                            <tr>
                                <td>
                                    <a class="btn btn-green" href="{{ route('site.enquete.ver',$registro->id) }}" title="Ver enquete">
                                        <span class="fas fa-eye"></span>
                                    </a>
                                    <a class="btn btn-danger" href="{{ route('admin.enquete.deletar',$registro->id) }}" onclick="return confirm('Tem certeza que deseja deletar a enquete?');" title="Deletar">
                                        <span class="fas fa-trash-alt"></span>
                                    </a>
                                </td>
                                <td>{{ $registro->texto }}</td>
                                <td>
                                    @php
                                        $total_votos = 0;
                                        foreach($registro->opcao as $opcao) {
                                            $total_votos += $opcao->votos;
                                        }
                                    @endphp
                                    {{ $total_votos }}
                                </td>
                                <td>
                                    <a class="btn btn-green" href="{{ route('admin.enquete.atualizar',$registro->id) }}" title="{{ $registro->is_aberta ? "Encerrar enquete" : "Abrir enquete" }}">
                                        <span class="fas {{ $registro->is_aberta ? 'fa-lock-open' : 'fa-lock' }}"></span>
                                        {{ $registro->is_aberta ? "Aberta" : "Encerrada" }}</td>
                                    </a>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td height="56px" colspan="4">Ainda não há enquetes.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection