@extends('layout.site')
@section('titulo', $evento->nome.' - CASA')

@section('conteudo')
<div class="news-page">
    <p><a href="{{ route('site.home') }}">Início</a> / <a href="{{ route('site.eventos') }}">Eventos</a> / {{ $evento->nome }}</p>
    <div class="news-item">
        <div id="eventos" class="news-title">
            <h1>{{ $evento->nome }}</h1>
            <p class="news-date">{{ date('d/m/Y', strtotime($evento->created_at)) }} por <a href="#">{{ $evento->user->name }}</a></p>
        </div>
        <div class="news-item-img">
            <img src="{{ asset($evento->anexo) }}" alt="">
        </div>
        <p>{{ $evento->descricao }}</p>
        <!--div class="news-item-text">
            {-- $evento->toArray()['texto'] --}
        </div-->
    </div>
</div>
@endsection