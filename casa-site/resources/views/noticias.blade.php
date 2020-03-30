<div id="noticias" class="item-title">
    <h1>Notícias</h1>
</div>
<div class="item">
    @foreach ($noticias as $noticia)
        @if($noticia->publicado)
            <div class="news-card">
                <div class="news-card-img">
                    <img src="{{ $noticia->anexo }}" alt="">
                </div>
                <div class="news-card-text">                            
                    <p>Autor: {{ $noticia->autor }}</p>
                    <h3>{{ $noticia->titulo }}</h3>
                    <a href="#noticias" class="btn">Ler mais</a>
                </div>
            </div>
        @endif
    @endforeach
</div>

