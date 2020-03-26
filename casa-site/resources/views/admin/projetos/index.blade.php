@extends('layout.site')
@section('titulo', 'Lista de Projetos')

@section('conteudo')
        <h1 class="">Lista de projetos</h1>

        <div>
            <table class="table">
                <thead>
                    <tr class="table-header">
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Publicado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @foreach ($registros as $registro)
                        <tr>
                            <td>{{ $registro->id }}</td>
                            <td>{{ $registro->nome }}</td>
                            <td>{{ $registro->publicado ? "Sim" : "Não" }}</td>
                            <td class="action-cell">
                                <a class="btn" href="{{ route('admin.projeto.editar',$registro->id) }}">Editar</a>
                                <a class="btn btn-danger" href="{{ route('admin.projeto.deletar',$registro->id) }}" onclick="return confirm('Tem certeza que deseja deletar o projeto?');">Deletar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            <a class="btn" href="{{ route('admin.projeto.adicionar') }}">Adicionar</a>
        </div>
@endsection