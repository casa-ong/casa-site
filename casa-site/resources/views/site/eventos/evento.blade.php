@extends('layout.site')
@section('titulo', $evento->nome.' | Casa')

@section('conteudo')
<div class="post">
        <div class="content main">
            @if(isset($evento->anexo))
                <div class="img">
                    <img src="{{ asset($evento->anexo) }}" alt="">
                </div>
            @endif
            <div class="text">
                <div class="title">
                    <h1>{{ $evento->nome }}</h1>
                </div>
                <p><strong>Realização: {{ strftime('%A, %d de %B  de %Y', strtotime($evento->data)).' às '.date('H:i', strtotime($evento->hora)) }}</strong></p>
                {!! $evento->toArray()['descricao'] !!}
                <p>Postado {{ strftime('%A, %d de %B  de %Y', strtotime($evento->created_at)) }}</p>
            </div>
        </div>
</div>
@endsection