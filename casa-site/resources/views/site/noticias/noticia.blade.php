@extends('layout.site')
@section('titulo', $noticia->titulo.' - CASA')

@section('conteudo')
<div class="news-page">
    <p><a href="{{ route('site.home') }}">Início</a> / <a href="{{ route('site.noticias') }}">Notícias</a> / {{ $noticia->titulo }}</p>
    <div class="news-item">
        <div id="noticias" class="news-title">
            <h1>{{ $noticia->titulo }}</h1>
            <p class="news-date">{{ date('d/m/Y', strtotime($noticia->created_at)) }} por <a href="#">{{ $noticia->autor }}</a></p>
            <p style="align-self: flex-start">{{ $noticia->manchete }}</p>
        </div>
        <div class="news-item-img">
            <img src="{{ asset($noticia->anexo) }}" alt="">
        </div>
        <div class="news-item-text">
            {!! $noticia->toArray()['texto'] !!}
        </div>
    </div>
</div>
@endsection