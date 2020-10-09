@extends('layout.site')
@section('titulo', 'Conta Bancária | Casa')

@section('conteudo')
    <div class="content">
        <div class="item-title">
            <h1 class="">Configurações e da Conta Bancária do site</h1>
            <a class="btn" href="{{ route('doacao.adicionar') }}">Atualizar Informações</a>
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
                        <th>Nome</th>
                        <th>CNPJ</th>
                        <th>Banco</th>
                        <th>Ult. alteração</th>
                        <th>Ações</th>
                        
                    </tr>
                </thead>
                <tbody class="table-body">
                    @foreach ($registros as $registro)
                        <tr>
                            <td>{{ $registro->nome }}</td>
                            <td>{{ $registro->cnpj }}</td>
                            <td>{{ $registro->banco }}
                            <td>{{ date('d/m/Y h:i', strtotime($registro->updated_at)) }}</td>
                            <td>
                                <a class="btn" href="#" title="Editar">
                                    <span class="fas fa-pencil-alt"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection