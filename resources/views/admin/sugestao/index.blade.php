@extends('layout.site')
@section('titulo', 'Lista de sugestões | Casa')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1 class="">Lista de Sugestões</h1>
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
                        <th>Ações</th>
                        <th>Status</th>
                        <th>Assunto</th>
                        <th>Email</th>
                        <th>Data de envio</th>
                    </tr>
                </thead>
                <tbody class="table-body">

                    @if(isset($registros) && count($registros) > 0)
                        @foreach ($registros as $registro)
                            <tr>
                                <td class="action-cell">
                                    <a class="btn btn-green" href="{{ route('admin.sugestao.ver',$registro->id) }}" title="Ver">
                                        <span class="fas fa-eye"></span>
                                    </a>
                                    <a class="btn btn-danger" href="{{ route('admin.sugestao.deletar',$registro->id) }}" onclick="return confirm('Tem certeza que deseja deletar essa sugestão?');" title="Deletar">
                                        <span class="fas fa-trash-alt"></span>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-green" href="{{ route('admin.sugestao.atualizar', $registro->id) }}" title="Marcar como {!! $registro->lida ? 'não lida' : 'lida' !!}">
                                        <span class="far {{ $registro->lida ? 'fa-check-square' : 'fa-square' }}"></span> {{ $registro->lida ? 'Lida' : 'Não lida' }}
                                    </a>
                                </td>
                                <td>{{ $registro->assunto }}</td>
                                <td>{{ $registro->email }}</td>
                                <td>{{ $registro->created_at }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td height="56px" colspan="5">Nenhuma sugestão recebida.</td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection