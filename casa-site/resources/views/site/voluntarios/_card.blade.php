<div class="card">
    
    @if(isset($registro->foto))
        <div class="card-img user-card">
            <a href="{{ route('admin.voluntario.ver', $registro->id) }}"><img src="{{ asset($registro->foto) }}" alt=""></a>
        </div>
    @endif

    <div class="card-text">                            
        <h4 style="font-weight: 500;">
            <a title="{{ $registro->name }}"  href="{{ route('admin.voluntario.ver', $registro->id) }}">{{ ucwords(strtolower($registro->name ?? '')) }}</a>
        </h4>
        <p>
            {{ $registro->getAge() }} anos

            @if(isset($registro->projeto))
                - <a href="{{ route('site.projeto', $registro->projeto->id ?? '') }}">
                    {{ $registro->projeto->nome ?? '' }} 
                </a>
            @endif

        </p>
        <p>{{ isset($registro->cidade) ? ucwords(strtolower($registro->cidade)).' - ' : '' }}{{ $registro->estado }}</p>
    </div>
</div>