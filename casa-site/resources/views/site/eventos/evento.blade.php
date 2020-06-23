@extends('layout.site')
@section('titulo', $evento->nome.' | Casa')

@section('conteudo')
<div class="post">
    <div>
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