@extends('layout.site')
@section('titulo', $evento->nome.' | Casa')

@section('conteudo')
    <p class="breadcrumbs"><a href="{{ route('site.home') }}">Início</a> / <a href="{{ route('site.eventos') }}">Eventos</a> / {{ $evento->nome }}</p>
    <div class="content">
        <div id="eventos" class="news-title">
            <h1>{{ $evento->nome }}</h1>
            <p>Postado dia {{ date('d/m/Y', strtotime($evento->created_at)) }} por <a href="#">{{ $evento->user->name }}</a></p>
        </div>
        <div class="img">
            <img src="{{ asset($evento->anexo) }}" alt="">
        </div>
        <p>Realização: {{ date('d/m/Y', strtotime($evento->data)) }}</p>
        <div class="text">
            {!! $evento->toArray()['descricao'] !!}
        </div>
    </div>
@endsection