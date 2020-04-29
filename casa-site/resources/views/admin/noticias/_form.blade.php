@if ($errors->any())
    <p class="error">Campos com * são obrigatórios!</p>
@endif
@php($user = Auth::user())
<input type="hidden" name="user_id" value="{{ $user->id }}">

<div class="input-field">
    <label for="titulo">Título*</label>
    <input class="{{ $errors->has('titulo') ? 'error' : '' }}" type="text" name="titulo" value="{{ isset($registro->titulo) ? $registro->titulo : old('titulo') }}" placeholder="Digite aqui o título da notícia">
    @error('titulo')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="input-field">
    <label for="texto">Manchete*</label>
    <textarea class="{{ $errors->has('manchete') ? 'error' : old('manchete') }}" name="manchete" type="text" placeholder="Digite aqui a manchete da notícia, ela aparecerá nos cards das notícias">{{ isset($registro->manchete) ? $registro->manchete : '' }}</textarea>
    @error('manchete')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="input-field">
    <label for="texto">Texto*</label>
    <textarea class="{{ $errors->has('texto') ? 'error' : old('texto') }}" id="summernote" name="texto" type="text" placeholder="Digite aqui o texto da notícia">{{ isset($registro->texto) ? $registro->texto : '' }}</textarea>
    @error('texto')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
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