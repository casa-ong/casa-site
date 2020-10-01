@php
    $user = Auth::user()
@endphp
<input type="hidden" name="user_id" value="{{ $user->id }}">
<input type="hidden" name="tipo" value="noticia">

@if(isset($registro))
    <p>Essa notícia está <strong>{{ isset($registro->publicado) && $registro->publicado == true ? 'publicada' : 'salva no rascunho'}}.</strong></p>
@endif

<div class="input-field">
    <label for="nome">Título*</label>
    <input class="{{ $errors->has('nome') ? 'error' : '' }}" type="text" name="nome" value="{{ isset($registro->nome) ? $registro->nome : old('nome') }}" placeholder="Digite aqui o título da notícia">
    @error('nome')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="input-field">
    <label for="descricao">Texto*</label>
    <textarea class="{{ $errors->has('descricao') ? 'error' : old('descricao') }}" id="summernote" name="descricao" type="text" placeholder="Digite aqui o descricao da notícia">{{ isset($registro->descricao) ? $registro->descricao : old('descricao')  }}</textarea>
    @error('descricao')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="input-field">
    <label for="anexo" class="input">Banner da notícia
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