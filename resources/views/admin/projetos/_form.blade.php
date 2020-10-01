@if(isset($registro))
    <p>Esse projeto está <strong>{{ isset($registro->publicado) && $registro->publicado == true ? 'publicado' : 'salvo no rascunho'}}.</strong></p>
@endif

<div class="input-field">
    <label for="nome">Nome*</label>
    <input class="{{ $errors->has('nome') ? 'error' : '' }}" type="text" name="nome" value="{{ isset($registro->nome) ? $registro->nome : old('nome') }}" placeholder="Digite aqui o nome do projeto">
    @error('nome')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="input-field">
    <label for="descricao">Descrição*</label>
    <textarea id="summernote" class="{{ $errors->has('descricao') ? 'error' : '' }}" type="text" name="descricao" placeholder="Descreva o projeto">{{ isset($registro->descricao) ? $registro->descricao : old('descricao') }}</textarea>
    @error('descricao')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="input-field">
    <label for="anexo" class="input">Banner do projeto
        <div class="banner-preview">
            <span class="fas fa-image"></span>
            <img id="img-banner" src="{{ isset($registro->anexo) ? asset($registro->anexo) : '' }}" alt="">
            <p>Escolher uma imagem jpeg, jpg, png ou gif<br>na proporção 3x7</p>
        </div>
        <input type="file" class="{{ $errors->has('anexo') ? 'error' : '' }}" id="anexo" name="anexo" onchange="document.getElementById('img-banner').src = window.URL.createObjectURL(this.files[0])">
    </label>
    @error('anexo')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>