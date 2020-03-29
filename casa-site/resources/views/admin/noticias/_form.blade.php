<input type="hidden" name="user_id" value="{{ Auth::id() }}">

<div class="input-field">
    <label for="titulo">Título</label>
    <input type="text" name="titulo" value="{{ isset($registro->titulo) ? $registro->titulo : '' }}" placeholder="Digite aqui o título da notícia">
</div>

<div class="input-field">
    <label for="texto">Texto</label>
    <input type="text" name="texto" value="{{ isset($registro->texto) ? $registro->texto : '' }}" placeholder="Digite aqui o texto da notícia">
</div>

<div class="input-field">
    <label for="autor">Autor</label>
    <input type="text" name="autor" value="{{ isset($registro->autor) ? $registro->autor : '' }}" placeholder="Digite aqui o nome do autor da notícia">
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

<label class="input-checkbox" for="publicado">Publicar agora?
    <input type="checkbox" name="publicado" {{ isset($registro->publicado) && $registro->publicado == true ? 'checked' : ''}} value="true">
    <span class="checkmark"></span>
</label>

<label class="input-checkbox" for="curtir">Curtir esta notícia?
    <input type="checkbox" name="curtir" {{ isset($registro->curtir) && $registro->curtir == true ? 'checked' : ''}} value="true">
    <span class="checkmark"></span>
</label>
