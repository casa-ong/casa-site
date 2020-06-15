@extends('layout.site')
@section('titulo', $noticia->titulo.' - CASA')

@section('conteudo')
    <div class="content">
        <div id="noticias" class="title">
            <h1>{{ $noticia->titulo }}</h1>
            <p>{{ date('d/m/Y', strtotime($noticia->created_at)) }} por <a href="#">{{ $noticia->autor }}</a></p>
            <p style="align-self: flex-start">{{ $noticia->manchete }}</p>
        </div>
        <div class="img">
            <img src="{{ asset($noticia->anexo) }}" alt="">
        </div>
        <div class="text">
            {!! $noticia->toArray()['texto'] !!}
        </div>
    </div>
@endsection