@extends('layout.site')
@section('titulo', $projeto->nome.' | Casa')

@section('conteudo')
<div class="post">
    <div>
        <div class="content">
            
            @if(isset($projeto->anexo))
                <div class="img">
                    <img src="{{ asset($projeto->anexo) }}" alt="">
                </div>
            @endif

            <div class="text">
                <div class="title">
                    <h1>{{ $projeto->nome }}</h1>
                </div>
                {!! $projeto->toArray()['descricao'] !!}
                <p>{{ strftime('%A, %d de %B  de %Y', strtotime($projeto->created_at)) }}</p>
            </div>
        </div>

        @if(isset($projetos) && count($projetos) > 0)
            <section class="sidebar under">
                <h1>Conheça outros <strong>projetos</strong></h1>
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