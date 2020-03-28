@extends('layout.site')
@section('titulo', 'Historico de configurações')

@section('conteudo')
        <h1 class="">Historico de configurações</h1>

        <div>
            <table class="table">
                <thead>
                    <tr class="table-header">
                        <th>Logo</th>
                        <th>Titulo</th>
                        <th>Slogan</th>
                        <th>Autor</th>
                        <th>Ações</th>
                        
                    </tr>
                </thead>
                <tbody class="table-body">
                    @foreach ($registros as $registro)
                        <tr>
                            <td>
                                <img src="{{ asset($registro->logo) }}" alt="">
                            </td>
                            <td>{{ $registro->titulo }}</td>
                            <td>{{ $registro->slogan}}</td>
                            <td>{{ $registro->user_id }}</td>
                            <td>
                                <a class="btn" href="{{ route('admin.dados_site.editar',$registro->id) }}">Republicar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            <a class="btn" href="{{ route('admin.dados_site.adicionar') }}">Nova configuração</a>
        </div>
@endsection