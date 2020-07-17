<div class="list-card">

    @if(isset($evento->anexo))
        <div class="card-img">
            <a href="{{ route('site.evento', $evento->id) }}"><img src="{{ asset($evento->anexo) }}" alt=""></a>
        </div>
    @endif
    
    <div class="card-text">                            
        <h4>
            <a title="{{ $evento->nome }}" href="{{ route('site.evento', $evento->id) }}">{{ $evento->nome }}</a>
        </h4>
        <p>
            {!! mb_strimwidth(strip_tags($evento->descricao), 0, 125, "...") !!}
        </p>
        <p><strong>{{ strftime('%A, %d de %B  de %Y', strtotime($evento->data)).' às '.date('H:i', strtotime($evento->hora)) }}</strong></p>
    </div>
    <div class="action text-center">
        <a href="{{ route('site.evento', $evento->id) }}" class="btn btn-green">Leia mais</a>
    </div>
</div>