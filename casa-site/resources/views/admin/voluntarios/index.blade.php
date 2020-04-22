@extends('layout.site')
@section('titulo', 'Lista de Voluntários')

@section('conteudo')
<div class="content">
        <div class="item-title">
            <h1 class="">Lista de Voluntários</h1>
            <a class="btn" href="{{ route('admin.voluntario.adicionar') }}">Adicionar</a>
        </div>
        <div class="table">
            <table>
                <thead>
                    <tr class="table-header">
                        <th>Nome</th>
                        <th>Email</th>
                        <th>CPF</th>
                        <th>Projeto</th>
                        <th>Aprovado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @foreach ($registros as $registro)
                        <tr>
                            <td>{{ $registro->name }}</td>
                            <td>{{ $registro->email }}</td>
                            <td>{{ $registro->cpf }}</td>
                            <td>{{ isset($registro->projeto_id) ? $registro->projeto->nome : "Nenhum" }}</td>
                            <td>{{ $registro->aprovado ? "Não" : "Sim" }}</td>
                            <td class="action-cell">
                                <a class="btn" href="{{ route('admin.voluntario.editar',$registro->id) }}" title="Editar">
                                    <span class="fas fa-pencil-alt"></span>
                                </a>
                                <a class="btn btn-danger" href="{{ route('admin.voluntario.deletar',$registro->id) }}" onclick="return confirm('Tem certeza que deseja deletar o voluntario?');" title="Deletar">
                                    <span class="fas fa-trash-alt"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection