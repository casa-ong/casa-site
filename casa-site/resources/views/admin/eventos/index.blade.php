@extends('layout.site')
@section('titulo', 'Lista de eventos | Casa')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1>Lista de Eventos</h1>
            <a class="btn btn-green" href="{{ route('admin.evento.adicionar') }}">Adicionar</a>
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
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Data</th>
                        <th>Publicado</th>
                        <th>Ações</th>
                        
                    </tr>
                </thead>
                <tbody class="table-body">
                    @foreach ($registros as $registro)
                        <tr>
                            <td>{{ $registro->id }}</td>
                            <td>{{ $registro->nome }}</td>
                            <td>{{ isset($registro->data) ? date('d/m/Y', strtotime($registro->data)).' às '.date('H:i', strtotime($registro->hora)) : 'Não definida' }}</td>
                            <td>{{ $registro->publicado ? "Sim" : "Não" }}</td>
                            <td>
                                <a class="btn btn-green" href="{{ route('admin.evento.editar',$registro->id) }}" title="Editar">
                                    <span class="fas fa-pencil-alt"></span>
                                </a>
                                <a class="btn btn-danger" href="{{ route('admin.evento.deletar',$registro->id) }}" onclick="return confirm('Tem certeza que deseja deletar o evento?');" title="Deletar">
                                    <span class="fas fa-trash-alt"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection