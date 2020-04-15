@extends('layout.site')
@section('titulo', 'Notícias - CASA')

@section('conteudo')

<div id="noticias" class="item-title">
    <h1>Notícias</h1>
</div>
<div class="item" style="border: 0px">
    @foreach ($noticias as $noticia)
        @include('site.noticias._card')
    @endforeach
</div>
<div class="page-nav">
    {{ $noticias->links() }}
</div>

@endsection
