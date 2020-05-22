@if ($errors->any())
    <p class="error">Campos com * são obrigatórios!</p>
@endif
<div class="input-field">
    <label for="nome">Nome*</label>
    <input class="{{ $errors->has('nome') ? 'error' : '' }}" type="text" name="nome" value="{{ isset($registro->nome) ? $registro->nome : old('nome') }}" placeholder="Digite aqui o nome do projeto">
    @error('nome')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="input-field">
    <label for="descricao">Descrição*</label>
    <textarea id="summernote" class="{{ $errors->has('descricao') ? 'error' : '' }}" type="text" name="descricao" placeholder="Descreva o projeto">{{ isset($registro->descricao) ? $registro->descricao : old('descricao') }}</textarea>
    @error('descricao')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="input-field">
    <label for="nome">Banner do projeto</label>
    <input type="file" class="{{ $errors->has('anexo') ? 'error' : '' }}" name="anexo" onchange="document.getElementById('img-banner').src = window.URL.createObjectURL(this.files[0])">
    @error('anexo')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="input-field">
    <img id="img-banner" src="{{ isset($registro->anexo) ? asset($registro->anexo) : '' }}" alt="">
</div>    

<label class="input-checkbox" for="publicado">Publicar agora?
    <input type="checkbox" name="publicado" {{ isset($registro->publicado) && $registro->publicado == true ? 'checked' : ''}} value="true">
    <span class="checkmark"></span>
</label>

