@extends('layout.site')
@section('titulo', 'Lista de newsletters | Casa')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1 class="">Lista de newsletters</h1>
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
                        <th>Email</th>
                        <th>Receber Eventos</th>
                        <th>Receber Projetos</th>
                        <th>Receber Notícias</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    
                    @if(isset($registros) && count($registros) > 0)
                        @foreach ($registros as $registro)
                            <tr>
                                <td class="action-cell">
                                    <a class="btn btn-green" href="{{ route('newsletter.editar',[$registro->id, $registro->token]) }}" title="Editar">
                                        <span class="fas fa-pencil-alt"></span>
                                    </a>
                                    <a class="btn btn-danger" href="{{ route('newsletter.deletar', [$registro->id, $registro->token]) }}" onclick="return confirm('Tem certeza que deseja deletar esta newsletter?');" title="Deletar">
                                        <span class="fas fa-trash-alt"></span>
                                    </a>
                                </td>
                                <td>{{ $registro->email_newsletter }}</td>
                                <td>{{ $registro->receber_eventos ? "Sim" : "Não" }}</td>
                                <td>{{ $registro->receber_projetos ? "Sim" : "Não" }}</td>
                                <td>{{ $registro->receber_noticias ? "Sim" : "Não" }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td height="56px" colspan="5">Nenhuma newsletter cadastrada.</td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection