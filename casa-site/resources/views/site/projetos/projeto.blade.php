@extends('layout.site')
@section('titulo', $projeto->nome.' - CASA')

@section('conteudo')
    <p class="breadcrumbs"><a href="{{ route('site.home') }}">Início</a> / <a href="{{ route('site.projetos') }}">Projetos</a> / {{ $projeto->nome }}</p>
    <div class="content">
        <div id="noticias" class="title">
            <h1>{{ $projeto->nome }}</h1>
            <p>{{ date('d/m/Y', strtotime($projeto->created_at)) }} por <a href="#">{{ $projeto->user->name }}</a></p>
        </div>
        <div class="img">
            <img src="{{ asset($projeto->anexo) }}" alt="">
        </div>
        <div class="text">
            {!! $projeto->toArray()['descricao'] !!}
        </div>
    </div>
@endsection