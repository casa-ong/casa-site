@extends('layout.site')
@section('titulo', 'Lista de eventos | Casa')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1>Lista de Eventos</h1>
            @if(Session::has('success'))
            <div class="alert alert-success" onclick="$(this).toggle('hide')">
                <p>{{ Session::get('success') }}</p>
            </div>
            @endif
        </div>
        <div class="item-actions">
            <a class="btn btn-green" href="{{ route('admin.evento.adicionar') }}">Novo evento</a>
        </div>

        @if(isset($registros) && count($registros) > 0)
            <div class="table">
                <table>
                    <thead>
                        <tr class="table-header">
                            <th>Ações</th>
                            <th>Nome</th>
                            <th>Data</th>
                            <th>
                                <label for="dropdown" class="btn-dropdown">
                                    @if($lista['all'])
                                        Status&nbsp;(Todos)
                                    @elseif($lista['drafts'])
                                        Status&nbsp;(Rascunhos)
                                    @elseif($lista['public'])
                                        Status&nbsp;(Publicados)
                                    @endif
                                    <i class="fas fa-caret-down"></i>
                                    <input type="checkbox" class="dropdown" id="dropdown">
                                    <div id="dropdown-links" class="dropdown-links">
                                        {!! !$lista['all'] ? '<a href="'.route('admin.eventos').'">Todos</a>' : '' !!}
                                        {!! !$lista['drafts'] ? '<a href="'.route('admin.eventos.rascunhos').'">Rascunhos</a>' : '' !!}
                                        {!! !$lista['public'] ? '<a href="'.route('admin.eventos.publicados').'">Publicados</a>' : '' !!}
                                    </div>
                                </label>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        @foreach ($registros as $registro)
                            <tr>
                                <td>
                                    <a class="btn btn-green" href="{{ route('admin.evento.editar',$registro->id) }}" title="Editar">
                                        <span class="fas fa-pencil-alt"></span>
                                    </a>
                                    <a class="btn btn-danger" href="{{ route('admin.evento.deletar',$registro->id) }}" onclick="return confirm('Tem certeza que deseja deletar o evento?');" title="Deletar">
                                        <span class="fas fa-trash-alt"></span>
                                    </a>
                                </td>
                                <td>{{ $registro->nome }}</td>
                                <td>{{ isset($registro->data) ? date('d/m/Y', strtotime($registro->data)).' às '.date('H:i', strtotime($registro->hora)) : 'Não definida' }}</td>
                                <td>{{ $registro->publicado ? "Publicado" : "Rascunho" }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>Ainda não há eventos.</p>
        @endif

    </div>
</div>
@endsection