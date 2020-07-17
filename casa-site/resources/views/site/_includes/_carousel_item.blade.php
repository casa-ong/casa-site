<div class="gallery-cell carousel-item" style="background: linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6) ), url('{{ asset($item->anexo) }}'); background-size: 100%;">
    <div class="carousel-title">
        @if($item->titulo)                     
            <h1><a href="{{ route('site.noticia', $item->id) }}">{{ $item->titulo }}</a></h1>
        @elseif($item->nome)
            <h1><a href="{{ route('site.evento', $item->id) }}">{{ $item->nome }}</a></h1>
        @endif
    </div>
</div>