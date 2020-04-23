<div class="user-card">
    <div class="card-img">
        <img src="{{ asset($registro->foto) }}" alt="">
    </div>
    <div class="card-data">
        <h4>{{ $registro->name }}</h4>
        <p>
            {{ $registro->getAge() }} anos - 
            <a href="{{ route('site.projeto', $registro->projeto->id ?? '') }}">
                {{ $registro->projeto->nome ?? '' }} 
            </a>
        </p>
        <p>{{ $registro->cidade}} - {{$registro->estado }}</p>
    </div>
</div>