<div class="list-card">
    <div class="card-img">
        <a href="{{ route('site.noticia', $noticia->id) }}"><img src="{{ asset($noticia->anexo) }}" alt=""></a>
    </div>
    <div class="card-text">                            
        <h4>
            <a title="{{ $noticia->titulo }}" href="{{ route('site.noticia', $noticia->id) }}">{{ $noticia->titulo }}</a>
        </h4>
        <p>
            {!! mb_strimwidth(strip_tags($noticia->texto), 0, 125, "...") !!}
        </p>
    </div>
    <div class="action text-center">
        <a href="{{ route('site.noticia', $noticia->id) }}" class="btn btn-green">Leia mais</a>
    </div>
</div>