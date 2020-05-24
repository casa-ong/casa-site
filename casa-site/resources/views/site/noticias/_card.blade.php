<div class="card">
    <div class="card-img">
        <a href="{{ route('site.noticia', $noticia->id) }}"><img src="{{ $noticia->anexo }}" alt=""></a>
    </div>
    <div class="card-text">                            
        <p>{{ date('d/m/Y', strtotime($noticia->created_at)) }} por <a href="{{ route('admin.voluntario.ver', $noticia->user->id) }}">{{ $noticia->user->name }}</a></p>
        <h4><a href="{{ route('site.noticia', $noticia->id) }}">{{ $noticia->titulo }}</a></h4>
        <p class="card-p">{{ $noticia->manchete }}</p>
    </div>
</div>