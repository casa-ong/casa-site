@extends('layout.site')
@section('titulo', 'Lista de notícias | Casa')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1 class="">Lista de notícias</h1>
            <a class="btn btn-green" href="{{ route('admin.noticia.adicionar') }}">Nova notícia</a>
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
                        <th>Título</th>
                        <th>Publicado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @foreach ($registros as $registro)
                        <tr>
                            <td>{{ $registro->id }}</td>
                            <td>{{ $registro->titulo }}</td>
                            <td>{{ $registro->publicado ? "Sim" : "Não" }}</td>
                            <td class="action-cell">
                                <a class="btn btn-green" href="{{ route('admin.noticia.editar',$registro->id) }}" title="Editar">
                                    <span class="fas fa-pencil-alt"></span>
                                </a>
                                <a class="btn btn-danger" href="{{ route('admin.noticia.deletar',$registro->id) }}" onclick="return confirm('Tem certeza que deseja deletar o projeto?');" title="Deletar">
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