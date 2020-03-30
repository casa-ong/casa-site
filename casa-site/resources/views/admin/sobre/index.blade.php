@extends('layout.site')
@section('titulo', 'Historico de configurações')

@section('conteudo')
    <div class="content">
        <h1 class="">Historico de configurações e sobre do site</h1>
        <div>
            <a class="btn" href="{{ route('admin.sobre.adicionar') }}">Nova configuração e sobre</a>
        </div>
        <div>
            <table class="table">
                <thead>
                    <tr class="table-header">
                        <th>Logo</th>
                        <th>Titulo do site</th>
                        <th>Slogan</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Sobre</th>
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
                            <td>{{ $registro->titulo_site }}</td>
                            <td>{{ $registro->slogan }}</td>
                            <td>{{ $registro->email }}</td>
                            <td>{{ $registro->telefone }}</td>
                            <td>{{ $registro->titulo_sobre }}</td>
                            <td>{{ $registro->user_id }}</td>
                            <td>
                                <a class="btn" href="{{ route('admin.sobre.editar',$registro->id) }}">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection