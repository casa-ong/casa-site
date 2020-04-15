<div class="news-card">
    <div class="news-card-img">
        <a href="{{ route('site.evento', $evento->id) }}"><img src="{{ $evento->anexo }}" alt=""></a>
    </div>
    <div class="news-card-text">                            
        <p>{{ date('d/m/Y', strtotime($evento->created_at)) }} por <a href="#">{{ $evento->user->name }}</a></p>
        <h4><a href="{{ route('site.evento', $evento->id) }}">{{ $evento->nome }}</a></h4>
        <p>Dia: {{ $evento->data }}</p>
        <!--p>{-- $evento->descricao --}</p-->
    </div>
</div>