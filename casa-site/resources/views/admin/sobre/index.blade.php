@extends('layout.site')
@section('titulo', 'Historico de configurações | Casa')

@section('conteudo')
    <div class="content">
        <div class="item-title">
            <h1 class="">Historico de configurações e sobre do site</h1>
            <a class="btn" href="{{ route('admin.sobre.adicionar') }}">Nova config.</a>
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
                        <th>Titulo do site</th>
                        <th>Autor</th>
                        <th>Ult. alteração</th>
                        <th>Ações</th>
                        
                    </tr>
                </thead>
                <tbody class="table-body">
                    @foreach ($registros as $registro)
                        <tr>
                            <td>{{ $registro->titulo_site }}</td>
                            <td>{{ $registro->user_id }}</td>
                            <td>{{ date('d/m/Y h:i', strtotime($registro->updated_at)) }}</td>
                            <td>
                                <a class="btn" href="{{ route('admin.sobre.editar',$registro->id) }}" title="Editar">
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