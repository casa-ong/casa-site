<div class="card">
    
    @if(isset($registro->foto))
        <div class="card-img" style="max-height: 15em;">
            <a href="{{ route('admin.voluntario.ver', $registro->id) }}"><img src="{{ asset($registro->foto) }}" alt=""></a>
        </div>
    @endif

    <div class="card-text">                            
        <h4 style="font-weight: 500;">
            <a title="{{ $registro->name }}"  href="{{ route('admin.voluntario.ver', $registro->id) }}">{{ $registro->name }}</a>
        </h4>
        <p>
            {{ $registro->getAge() }} anos

            @if(isset($registro->projeto))
                - <a href="{{ route('admin.voluntario.ver', $registro->projeto->id ?? '') }}">
                    {{ $registro->projeto->nome ?? '' }} 
                </a>
            @endif

        </p>
        <p>{{ isset($registro->cidade) ? $registro->cidade.' - ' : '' }}{{ $registro->estado }}</p>
    </div>
</div>