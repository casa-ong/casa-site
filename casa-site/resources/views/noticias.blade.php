@extends('layout.site')
@section('titulo', 'Notícias - CASA')

@section('conteudo')

<div id="noticias" class="item-title">
    <h1>Notícias</h1>
</div>
<div class="item" style="border: 0px">
    @foreach ($noticias as $noticia)
        @if($noticia->publicado)
            <div class="news-card">
                <div class="news-card-img">
                    <a href="{{ route('site.noticia', $noticia->id) }}"><img src="{{ $noticia->anexo }}" alt=""></a>
                </div>
                <div class="news-card-text">                            
                    <p>{{ date('d/m/Y', strtotime($noticia->created_at)) }} por <a href="#">{{ $noticia->autor }}</a></p>
                    <h4><a href="{{ route('site.noticia', $noticia->id) }}">{{ $noticia->titulo }}</a></h4>
                    <p class="news-card-p">{{ $noticia->texto }}</p>
                </div>
            </div>
        @endif
    @endforeach
</div>
<div class="page-nav">
    {{ $noticias->links() }}
</div>

@endsection
