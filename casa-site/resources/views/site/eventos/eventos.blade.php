@extends('layout.site')
@section('titulo', 'Lista de Eventos')

@section('conteudo')
        <div id="eventos" class="item-title">
            <h1>Eventos</h1>
        </div>
        <div class="item" style="border: 0;">
        @if(isset($eventos) && count($eventos) > 0)
            @foreach ($eventos as $evento)
                @include('site.eventos._card')
            @endforeach
        @else
            <p>Eita, ainda não houve nenhum evento, digite seu email abaixo para saber das novidades</p>
        @endif
        </div>
@endsection