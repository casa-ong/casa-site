<div class="card">
    <div class="card-img">
        <a href="{{ route('site.projeto', $projeto->id) }}"><img src="{{ $projeto->anexo }}" alt=""></a>
    </div>
    <div class="card-text">                            
        <p>{{ date('d/m/Y', strtotime($projeto->created_at)) }} por <a href="#">{{ $projeto->user->name }}</a></p>
        <h4><a href="{{ route('site.projeto', $projeto->id) }}">{{ $projeto->nome }}</a></h4>
    </div>
</div>