<div class="card">
    
    @if(isset($registro->anexo))
        <div class="card-img">
            <a href="{{ route('site.'.($registro->tipo == 'evento' ? 'evento' : 'noticia'), $registro->id) }}"><img src="{{ asset($registro->anexo) }}" alt=""></a>
        </div>
    @endif

    <div class="card-text">                            
        <h4>
            <a href="{{ route('site.'.($registro->tipo == 'evento' ? 'evento' : 'noticia'), $registro->id) }}">{{ $registro->nome }}</a>
        </h4>
        
        @if($registro->tipo == 'evento')    
            <p>Data: {{ date('d/m/Y', strtotime($registro->data)) }}</p>
        @endif

        <div class="action text-center">
            <a href="{{ route('site.'.($registro->tipo == 'evento' ? 'evento' : 'noticia'), $registro->id) }}" class="btn btn-green">Leia mais</a>
        </div>
    </div>
</div>