@extends('layout.site')
@section('titulo', $projeto->nome.' - CASA')

@section('conteudo')
<div class="news-page">
    <p><a href="{{ route('site.home') }}">Início</a> / <a href="{{ route('site.projetos') }}">Projetos</a> / {{ $projeto->nome }}</p>
    <div class="news-item">
        <div id="noticias" class="news-title">
            <h1>{{ $projeto->nome }}</h1>
            <p class="news-date">{{ date('d/m/Y', strtotime($projeto->created_at)) }} por <a href="#">{{ $projeto->user->name }}</a></p>
        </div>
        <div class="news-item-img">
            <img src="{{ asset($projeto->anexo) }}" alt="">
        </div>
        <div class="news-item-text">
            {!! $projeto->toArray()['descricao'] !!}
        </div>
    </div>
</div>
@endsection