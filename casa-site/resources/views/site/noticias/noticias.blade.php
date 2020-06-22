@extends('layout.site')
@section('titulo', 'Notícias | Casa')

@section('conteudo')
<div id="noticias" class="anchor item-title">
    <h1><strong>Notícias</strong></h1>
</div>
@if(isset($noticias) && count($noticias) > 0)
    <div class="item border-0">
        @foreach ($noticias as $noticia)
            @include('site.noticias._list')
        @endforeach
    </div>
    <div class="content-footer">
        <div class="page-nav">
            {{ $noticias->links() }}
        </div>
    </div>
@else
    <div class="item border-0 text-center">
        <p>Ops, ainda não temos nenhuma novidade, <strong>digite seu e-mail abaixo</strong> para receber as últimas notícias!</p>
    </div>
@endif
@endsection
