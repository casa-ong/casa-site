@extends('layout.site')
@section('titulo', $noticia->titulo.' - CASA')

@section('conteudo')
<div class="news-page">
    <div class="news-item">
        <div id="noticias" class="news-title">
            <h1>{{ $noticia->titulo }}</h1>
        </div>
        <div class="news-item-img">
            <img src="{{ asset($noticia->anexo) }}" alt="">
        </div>
        <div class="news-item-text">
            <p>{{ date('d/m/Y', strtotime($noticia->created_at)) }} por <a href="#">{{ $noticia->autor }}</a></p>
            <p class="news-item-p">{{ $noticia->texto }}</p>
        </div>
    </div>
</div>
@endsection