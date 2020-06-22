@extends('layout.site')
@section('titulo', $projeto->nome.' | Casa')

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
        @include('site._includes._ultimas_noticias_sidebar')
    </section>
</div>
@endsection