<div class="card">
    @if(isset($evento->anexo))
        <div class="card-img">
            <a href="{{ route('site.evento', $evento->id) }}"><img src="{{ $evento->anexo }}" alt=""></a>
        </div>
    @endif
    <div class="card-text">                            
        <p><a href="#">{{ $evento->user->name }}</a></p>
        <h4><a href="{{ route('site.evento', $evento->id) }}">{{ $evento->nome }}</a></h4>
        <p>Data: {{ date('d/m/Y', strtotime($evento->data)) }}</p>
        <!--p>{-- $evento->descricao --}</p-->
    </div>
</div>