<div id="sobre" class="item-title">
    <h1>Sobre nós</h1>
</div>
<div class="item">
    <div class="sobre-card" style="background-image: linear-gradient( rgba(255,255,255,0.9), rgba(255,255,255,0.9) ), url({{ isset($sobre->anexo_sobre) ? asset($sobre->anexo_sobre) : '' }});">
        {!! isset($sobre->texto_sobre) ? $sobre->toArray()['texto_sobre'] : '' !!}
    </div>
</div>
