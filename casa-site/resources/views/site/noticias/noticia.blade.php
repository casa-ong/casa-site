@extends('layout.site')
@section('titulo', $noticia->titulo.' | Casa')

@section('conteudo')
<div class="post">
    <div>
        <div class="content">
            @if (isset($noticia->anexo))
                <div class="img">
                    <img src="{{ asset($noticia->anexo) }}" alt="">
                </div>
            @endif
            <div class="text">
                <div class="title">
                    <h1>{{ $noticia->titulo }}</h1>
                </div>
                <p style="align-self: flex-start">{{ $noticia->manchete }}</p>
                {!! $noticia->toArray()['texto'] !!}
                <p>{{ strftime('%A, %d de %B  de %Y', strtotime($noticia->created_at)) }}</p>
            </div>
        </div>

        @if(isset($projetos) && count($projetos) > 0)
            <section class="sidebar under">
                <h1>Conheça alguns de <strong>nossos projetos</strong></h1>
                @include('site._includes._projetos_suggestions')
            </section>
        @endif

    </div>

    @if(isset($noticias) && count($noticias) > 0)
        <section class="sidebar">
            <h1>Últimas <strong>notícias</strong></h1>
            @include('site._includes._ultimas_noticias_sidebar')
        </section>
    @endif

</div>
@endsection