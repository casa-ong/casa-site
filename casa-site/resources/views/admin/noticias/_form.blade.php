@php($user = Auth::user())
<input type="hidden" name="user_id" value="{{ $user->id }}">

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
    <label for="texto">Manchete*</label>
    <textarea class="{{ $errors->has('manchete') ? 'error' : old('manchete') }}" name="manchete" type="text" placeholder="Digite aqui a manchete da notícia, ela aparecerá nos cards das notícias">{{ isset($registro->manchete) ? $registro->manchete : old('manchete') }}</textarea>
    @error('manchete')
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
    <label for="nome">Banner da notícia</label>
    <input type="file" class="{{ $errors->has('anexo') ? 'error' : '' }}" name="anexo" onchange="document.getElementById('img-banner').src = window.URL.createObjectURL(this.files[0])">
    @error('anexo')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="input-field">
    <img id="img-anexo" src="{{ isset($registro->anexo) ? asset($registro->anexo) : '' }}" alt="">
</div>    

<label class="input-checkbox" for="publicado">Publicar agora?
    <input type="checkbox" name="publicado" {{ isset($registro->publicado) && $registro->publicado == true ? 'checked' : ''}} value="true">
    <span class="checkmark"></span>
</label>