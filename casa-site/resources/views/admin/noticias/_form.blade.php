@php($user = Auth::user())
<input type="hidden" name="user_id" value="{{ $user->id }}">

@if(isset($registro))
    <p>Essa notícia está <strong>{{ isset($registro->publicado) && $registro->publicado == true ? 'publicada' : 'salva no rascunho'}}.</strong></p>
@endif

<div class="input-field">
    <label for="titulo">Título*</label>
    <input class="{{ $errors->has('titulo') ? 'error' : '' }}" type="text" name="titulo" value="{{ isset($registro->titulo) ? $registro->titulo : old('titulo') }}" placeholder="Digite aqui o título da notícia">
    @error('titulo')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="input-field">
    <label for="texto">Texto*</label>
    <textarea class="{{ $errors->has('texto') ? 'error' : old('texto') }}" id="summernote" name="texto" type="text" placeholder="Digite aqui o texto da notícia">{{ isset($registro->texto) ? $registro->texto : old('texto')  }}</textarea>
    @error('texto')
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