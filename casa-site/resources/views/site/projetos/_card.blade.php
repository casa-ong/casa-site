<div class="news-card" style="height: 15em">
    <div class="news-card-img">
        <a href="{{ route('site.projeto', $projeto->id) }}"><img src="{{ $projeto->anexo }}" alt=""></a>
    </div>
    <div class="news-card-text" style="height: 0em">                            
        <p>{{ date('d/m/Y', strtotime($projeto->created_at)) }} por <a href="#">{{ $projeto->user->name }}</a></p>
        <h4><a href="{{ route('site.projeto', $projeto->id) }}">{{ $projeto->nome }}</a></h4>
    </div>
</div>