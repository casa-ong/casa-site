@extends('layout.site')
@section('titulo', $registro->nome.' | Casa')

@section('conteudo')
<div class="post">
    <div>
        <div class="content">
            @if(isset($registro->anexo))
                <div class="img">
                    <img src="{{ asset($registro->anexo) }}" alt="">
                </div>
            @endif
            <div class="text">
                <div class="title">
                    <h1>{{ $registro->nome }}</h1>
                </div>
                
                @if($registro->tipo == 'evento')
                    <p><strong>Realização: {{ strftime('%A, %d de %B  de %Y', strtotime($registro->data)).' às '.date('H:i', strtotime($registro->hora)) }}</strong></p>
                @endif

                {!! $registro->toArray()['descricao'] !!}
                <p>{{ strftime('%A, %d de %B  de %Y', strtotime($registro->created_at)) }}</p>
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