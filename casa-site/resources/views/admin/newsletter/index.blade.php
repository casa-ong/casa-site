@extends('layout.site')
@section('titulo', 'Lista de newsletters')

@section('conteudo')
    <div class="content">
        <div class="item-title">
            <h1 class="">Lista de newsletters</h1>
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
        </div>
        <div class="table">
            <table>
                <thead>
                    <tr class="table-header">
                        <th>Email</th>
                        <th>Receber Eventos</th>
                        <th>Receber Projetos</th>
                        <th>Receber Notícias</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @foreach ($registros as $registro)
                        <tr>
                            <td>{{ $registro->email_newsletter }}</td>
                            <td>{{ $registro->receber_eventos ? "Sim" : "Não" }}</td>
                            <td>{{ $registro->receber_projetos ? "Sim" : "Não" }}</td>
                            <td>{{ $registro->receber_noticias ? "Sim" : "Não" }}</td>
                            <td class="action-cell">
                                <a class="btn" href="{{ route('admin.newsletter.editar',$registro->id) }}" title="Editar">
                                    <span class="fas fa-pencil-alt"></span>
                                </a>
                                <a class="btn btn-danger" href="{{ route('admin.newsletter.deletar',$registro->id) }}" onclick="return confirm('Tem certeza que deseja deletar esta newsletter?');" title="Deletar">
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