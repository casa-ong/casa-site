<div class="news-card">
    <div class="news-card-img">
        <a href="{{ route('site.noticia', $noticia->id) }}"><img src="{{ $noticia->anexo }}" alt=""></a>
    </div>
    <div class="news-card-text">                            
        <p>{{ date('d/m/Y', strtotime($noticia->created_at)) }} por <a href="#">{{ $noticia->autor }}</a></p>
        <h4><a href="{{ route('site.noticia', $noticia->id) }}">{{ $noticia->titulo }}</a></h4>
        <p class="news-card-p">{{ $noticia->manchete }}</p>
    </div>
</div>