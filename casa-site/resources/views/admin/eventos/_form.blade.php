<div class="input-field">
    <label for="nome">Nome</label>
    <input type="text" name="nome" value="{{ isset($registro->nome) ? $registro->nome : '' }}" placeholder="Digite aqui o nome do evento">
</div>
<div class="input-field">
    <label for="nome">Descrição</label>
    <textarea type="text" name="descricao" placeholder="Descreva aqui como será o evento">{{ isset($registro->descricao) ? $registro->descricao : '' }}</textarea>
</div>
<div class="input-field">
    <label for="nome">Anexo</label>
    <input type="file" name="anexo">
</div>

@if(@isset($registro->anexo))
    <div class="input-field">
        <img src="{{ asset($registro->anexo) }}" alt="">
    </div>    
@endisset

<div class="input-field">
    <label for="nome">Data</label>
    <input type="date" name="data" value="{{ isset($registro->data) ? $registro->data : '' }}" placeholder="Digite a data do evento">
</div>

<label class="input-checkbox" for="publicado">Publicar agora?
    <input type="checkbox" name="publicado" {{ isset($registro->publicado) && $registro->publicado == true ? 'checked' : ''}} value="true">
    <span class="checkmark"></span>
</label>

