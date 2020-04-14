@extends('layout.site')
@section('titulo', 'Lista de Eventos')

@section('conteudo')
        <div id="eventos" class="item-title">
            <h1>Eventos</h1>
        </div>
        <div class="item">
            @foreach ($eventos as $evento)
                @include('site.eventos._card')
            @endforeach
        </div>
@endsection