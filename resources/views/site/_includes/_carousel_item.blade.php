<div class="gallery-cell carousel-item" style="background: linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6) ), url('{{ asset($item->anexo) }}'); background-size: 100%;">
    <div class="carousel-title">
        <h1><a href="{{ route('site.'.($item->tipo == 'evento' ? 'evento' : 'noticia'), $item->id) }}">{{ $item->nome }}</a></h1>
    </div>
</div>