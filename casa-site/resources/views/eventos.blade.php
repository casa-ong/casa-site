@extends('layout.site')
@section('titulo', 'Lista de Eventos')

@section('conteudo')
        <div class="item-title">
            <h1>Eventos</h1>
        </div>
        <div class="item">
            @foreach ($registros as $registro)
                @if($registro->publicado)
                    <div class="list-eventos">
                        <div class="img-eventos">
                            <img src="{{ $registro->anexo }}" alt="">
                        </div>
                        <div class="text-evento">
                            <h1>{{ $registro->nome }}</h1>
                            <p>Dia: {{ $registro->data }}</p>
                            <p>{{ $registro->descricao }}</p>
                        </div>
                    </div>
                    <hr>
                @endif
            @endforeach
        </div>
@endsection