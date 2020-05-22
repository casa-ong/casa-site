@extends('layout.site')
@section('titulo', 'Notícias - CASA')
@section('anchor', 'noticias')

@section('conteudo')
<div class="item-title">
    <h1>Notícias</h1>
</div>
<div class="item" style="border: 0px">
    @if(isset($noticias) && count($noticias) > 0)
        @foreach ($noticias as $noticia)
            @include('site.noticias._card')
        @endforeach
    @else
        <p>Ops, ainda não temos nenhuma novidade...</p>
    @endif
</div>
<div class="content-footer">
    <div class="page-nav">
        {{ $noticias->links() }}
    </div>
</div>
@endsection
