@extends('layout.site')
@section('titulo', 'Lista de Voluntários')

@section('conteudo')
        <h1 class="">Lista de Voluntários</h1>

        <div>
            <table class="table">
                <thead>
                    <tr class="table-header">
                        <th>Foto</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>CPF</th>
                        <th>Profissão</th>
                        <th>Aprovação pendente</th>
                        <th>É admin?</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @foreach ($registros as $registro)
                        <tr>
                            <td>
                                <img class="table-picture" src="{{ asset($registro->foto) }}" alt="">
                            </td>
                            <td>{{ $registro->name }}</td>
                            <td>{{ $registro->email }}</td>
                            <td>{{ $registro->telefone }}</td>
                            <td>{{ $registro->cpf }}</td>
                            <td>{{ $registro->profissao }}</td>
                            <td>{{ $registro->aprovado ? "Não" : "Sim" }}</td>
                            <td>{{ $registro->admin ? "Sim" : "Não" }}</td>
                            <td class="action-cell">
                                <a class="btn" href="{{ route('admin.voluntario.editar',$registro->id) }}">Editar</a>
                                <a class="btn btn-danger" href="{{ route('admin.voluntario.deletar',$registro->id) }}" onclick="return confirm('Tem certeza que deseja deletar o voluntario?');">Deletar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            <a class="btn" href="{{ route('admin.voluntario.adicionar') }}">Adicionar</a>
        </div>
@endsection