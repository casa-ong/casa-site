@extends('layout.site')
@section('titulo', 'Lista de Sugestões')

@section('conteudo')
    <div class="content">
        <div class="item-title">
            <h1 class="">Lista de Sugestões</h1>
        </div>
        <div class="table">
            <table>
                <thead>
                    <tr class="table-header">
                        <th>Assunto</th>
                        <th>Data de envio</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @foreach ($registros as $registro)
                        <tr>
                            <td>{{ $registro->assunto }}</td>
                            <td>{{ $registro->created_at }}</td>
                            <td>{{ $registro->email }}</td>
                            <td>
                                <a class="btn" href="{{ route('admin.sugestao.atualizar', $registro->id) }}" title="Marcar como {!! $registro->lida ? 'não lida' : 'lida' !!}">
                                    <span class="far {{ $registro->lida ? 'fa-check-square' : 'fa-square' }}"></span> {{ $registro->lida ? 'Lida' : 'Não lida' }}
                                </a>
                            </td>
                            <td class="action-cell">
                                <a class="btn" href="#">
                                    <span class="fas fa-eye"></span>
                                </a>
                                <a class="btn btn-danger" href="{{ route('admin.sugestao.deletar',$registro->id) }}" onclick="return confirm('Tem certeza que deseja deletar essa sugestão?');" title="Deletar">
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