@extends('layout.site')
@section('titulo', 'Sugestões')


@section('conteudo')

        <div>
            @foreach ($registros as $registro)
                    <div class="list-projetos">
                        <div class="img-projetos">
                            <img src="{{ $registro->anexo }}" alt="">
                        </div>
                        <div class="text-projeto">
                            <h1>{{ $registro->assunto }}</h1>
                            <p>{{ $registro->mensagem }}</p>
                        </div>
                    </div>
                    <hr>
              
            @endforeach
        </div>
@endsection