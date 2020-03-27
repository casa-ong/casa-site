@extends('layout.site')
@section('titulo', 'Lista de Projetos')

@section('conteudo')

        <div>
            @foreach ($registros as $registro)
                @if($registro->publicado)
                    <div class="list-projetos">
                        <div class="img-projetos">
                            <img src="{{ $registro->anexo }}" alt="">
                        </div>
                        <div class="text-projeto">
                            <h1>{{ $registro->nome }}</h1>
                            <p>{{ $registro->descricao }}</p>
                        </div>
                    </div>
                    <hr>
                @endif
            @endforeach
        </div>
@endsection