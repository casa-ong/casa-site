@extends('layout.site')
@section('titulo', 'Depesas | Casa')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1 class="">Lista de despesas</h1>
            <a class="btn btn-green" href="{{ route('admin.despesa.adicionar') }}">Nova despesa</a>
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
                        <th width="40%">Nome</th>
                        <th width="20%">Usuário</th>
                        <th width="20%">Valor</th>
                    </tr>
                </thead>
                <tbody class="table-body">

                    @if(isset($registros) && count($registros) > 0)
                        @foreach ($registros as $registro)
                            <tr>
                                <td class="action-cell">
                                    <a class="btn btn-green" href="{{ route('admin.despesa.editar',$registro->id) }}" title="Editar">
                                        <span class="fas fa-pencil-alt"></span>
                                    </a>
                                    <a class="btn btn-danger" href="{{ route('admin.despesa.deletar',$registro->id) }}" onclick="return confirm('Tem certeza que deseja deletar a despesa?');" title="Deletar">
                                        <span class="fas fa-trash-alt"></span>
                                    </a>
                                </td>
                                <td>{{ $registro->nome }}</td>
                                <td>{{ isset($registro->user_id) ? $registro->user->name : "Nenhum" }}</td>
                                <td>R${{ $registro->valor }}</td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td height="56px" colspan="4">Ainda não há despesas.</td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection