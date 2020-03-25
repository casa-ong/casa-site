<div class="input-field">
    <label for="nome">Nome</label>
    <input type="text" name="nome" value="{{ isset($registro->nome) ? $registro->nome : '' }}" placeholder="Digite aqui o nome do projeto">
</div>
<div class="input-field">
    <label for="nome">Descrição</label>
    <textarea type="text" name="descricao" placeholder="Descreva o projeto">{{ isset($registro->descricao) ? $registro->descricao : '' }}</textarea>
</div>
<div class="input-field">
    <label for="nome">Anexo</label>
    <input type="file" name="anexos">
</div>

@if(@isset($registro->anexos))
    <div class="input-field">
        <img src="{{ asset($registro->anexos) }}" alt="">
    </div>    
@endisset

<label class="input-checkbox" for="publicado">Publicar agora?
    <input type="checkbox" name="publicado" {{ isset($registro->publicado) && $registro->publicado == true ? 'checked' : ''}} value="true">
    <span class="checkmark"></span>
</label>

