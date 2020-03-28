@extends('layout.site')
@section('titulo', 'Lista de Sugestões')

@section('conteudo')
        <h1 class="">Lista de Sugestões</h1>

        <div>
            <table class="table">
                <thead>
                    <tr class="table-header">
                        <th>Assunto</th>
                        <th>Mensagem</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @foreach ($registros as $registro)
                        <tr>
                            <td>{{ $registro->assunto }}</td>
                            <td>{{ $registro->mensagem }}</td>
                            <td>{{ $registro->email }}</td>
                            <td>{{ $registro->telefone }}</td>
                            <td class="action-cell">
                                <a class="btn" href="{{ route('admin.sugestao.editar',$registro->id) }}">Editar</a>
                                <a class="btn btn-danger" href="{{ route('admin.sugestao.deletar',$registro->id) }}" onclick="return confirm('Tem certeza que deseja deletar essa sugestão?');">Deletar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            <a class="btn" href="{{ route('sugestao.adicionar') }}">Adicionar</a>
        </div>
@endsection