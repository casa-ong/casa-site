@extends('layout.site')
@section('titulo', 'Lista de Noticias')

@section('conteudo')

        <div>
            @foreach ($registros as $registro)
                @if($registro->publicado)
                    <div class="list-noticias">
                        <div class="img-noticias">
                            <img src="{{ $registro->anexo }}" alt="">
                        </div>
                        <div class="text-noticia">                            
                            <h1>{{ $registro->titulo }}</h1>
                            <p>Autor: {{ $registro->autor }}</p>
                        </div>
                    </div>
                    <hr>
                @endif
            @endforeach
        </div>
@endsection

