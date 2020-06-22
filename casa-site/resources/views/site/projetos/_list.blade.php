<div class="list-card">
    <div class="card-img">
        <a href="{{ route('site.projeto', $projeto->id) }}"><img src="{{ asset($projeto->anexo) }}" alt=""></a>
    </div>
    <div class="card-text">                            
        <h4>
            <a title="{{ $projeto->nome }}" href="{{ route('site.projeto', $projeto->id) }}">{{ $projeto->nome }}</a>
        </h4>
        <p>
            {!! mb_strimwidth(strip_tags($projeto->descricao), 0, 125, "...") !!}
        </p>
    </div>
    <div class="action text-center">
        <a href="{{ route('site.projeto', $projeto->id) }}" class="btn btn-green">Leia mais</a>
    </div>
</div>