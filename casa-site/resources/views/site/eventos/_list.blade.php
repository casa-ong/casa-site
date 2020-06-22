<div class="list-card">

    @if(isset($evento->anexo))
        <div class="card-img">
            <a href="{{ route('site.evento', $evento->id) }}"><img src="{{ asset($evento->anexo) }}" alt=""></a>
        </div>
    @endif
    
    <div class="card-text">                            
        <h4>
            <a title="{{ $evento->nome }}" href="{{ route('site.eventos', $evento->id) }}">{{ $evento->nome }}</a>
        </h4>
        <p>
            {!! mb_strimwidth(strip_tags($evento->descricao), 0, 125, "...") !!}
        </p>
    </div>
    <div class="action text-center">
        <a href="{{ route('site.evento', $evento->id) }}" class="btn btn-green">Leia mais</a>
    </div>
</div>