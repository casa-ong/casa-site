<div class="list-card">

    @if(isset($registro->anexo))
        <div class="card-img">
            <a href="{{ route('site.'.($registro->tipo == 'evento' ? 'evento' : 'noticia'), $registro->id) }}"><img src="{{ asset($registro->anexo) }}" alt=""></a>
        </div>
    @endif
    
    <div class="card-text">                            
        <h4>
            <a title="{{ $registro->nome }}" href="{{ route('site.'.($registro->tipo == 'evento' ? 'evento' : 'noticia'), $registro->id) }}">{{ $registro->nome }}</a>
        </h4>
        <p>
            {!! mb_strimwidth(strip_tags($registro->descricao), 0, 125, "...") !!}
        </p>

        @if($registro->tipo == 'evento')
            <p><strong>{{ strftime('%A, %d de %B  de %Y', strtotime($registro->data)).' às '.date('H:i', strtotime($registro->hora)) }}</strong></p>
        @endif    

    </div>
    <div class="action text-center">
        <a href="{{ route('site.'.($registro->tipo == 'evento' ? 'evento' : 'noticia'), $registro->id) }}" class="btn btn-green">Leia mais</a>
    </div>
</div>