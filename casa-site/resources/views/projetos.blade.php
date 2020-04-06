<div id="projetos" class="item-title">
    <h1>Nossos projetos</h1>
</div>
<div class="item">
    <div style="display: flex; flex-direction: row">
    @if(isset($registros[0]) && $registros[0]->publicado)
            <div class="card-big" style="background-image: linear-gradient( rgba(0,0,0,0.9), rgba(0,0,0,0.6) ), url({{ isset($registros[0]->anexo) ? asset($registros[0]->anexo) : '' }});">
                <h1>{{ $registros[0]->nome }}</h1>
                <p>{{ App\User::find($registros[0]->user_id)->name }}</p>
                <p class="card-description">{{ $registros[0]->descricao }}</p>
            </div>
    @endif
        <div>
            @for ($i = 1; $i < (count($registros) > 3 ? 3 : count($registros)); $i++)
                @if($registros[$i]->publicado)
                    <div class="card" style="background-image: linear-gradient( rgba(0,0,0,0.9), rgba(0,0,0,0.6) ), url({{ isset($registros[$i]->anexo) ? asset($registros[$i]->anexo) : '' }});">
                        <h1>{{ $registros[$i]->nome }}</h1>
                        <p>{{ App\User::find($registros[$i]->user_id)->name }}</p>
                        <p class="card-description">{{ $registros[$i]->descricao }}</p>
                    </div>
                @endif
            @endfor
        </div>
    </div>
    {{--<div style="display: flex; flex-direction: row; flex-wrap: wrap;">
        @for ($i = 3; $i < count($registros); $i++)
            @if($registros[$i]->publicado)
                <div class="card" style="background-image: linear-gradient( rgba(0,0,0,0.9), rgba(0,0,0,0.6) ), url({{ isset($registros[$i]->anexo) ? asset($registros[$i]->anexo) : '' }});">
                    <h1>{{ $registros[$i]->nome }}</h1>
                    <p>{{ App\User::find($registros[$i]->user_id)->name }}</p>
                    <p class="card-description">{{ $registros[$i]->descricao }}</p>
                </div>
            @endif
        @endfor
    </div>--}}
</div>