@extends('layout.site')
@section('titulo', $projeto->nome.' - CASA')

@section('conteudo')
<div class="post">
    <div class="content">
        <div class="img">
            <img src="{{ asset($projeto->anexo) }}" alt="">
        </div>
        <div class="text">
            <div id="noticias" class="title">
                <h1>{{ $projeto->nome }}</h1>
            </div>
            {!! $projeto->toArray()['descricao'] !!}
            <p>{{ strftime('%A, %d de %B  de %Y', strtotime($projeto->created_at)) }}</p>
        </div>
    </div>
    <section class="sidebar">
        <h1>Últimas <strong>notícias<strong></h1>
        <div class="row align-center">

            @if(isset($noticias) && count($noticias) > 0)
            @foreach ($noticias as $noticia)
                @include('site.noticias._card')
            @endforeach
            @else
                <p>Ops, ainda não temos nenhuma novidade...</p>
            @endif

        </div>
    </section>
</div>
@endsection