<div id="sobre" class="item-title">
    <h1>{{ isset($sobre->titulo_sobre) ? $sobre->titulo_sobre : '' }}</h1>
</div>
<div class="item">
    <div class="sobre-card" style="background-image: linear-gradient( rgba(255,255,255,0.9), rgba(255,255,255,0.9) ), url({{ isset($sobre->anexo_sobre) ? asset($sobre->anexo_sobre) : '' }});">
        <p>{{ isset($sobre->texto_sobre) ? $sobre->texto_sobre : '' }}</p>
    </div>
</div>
