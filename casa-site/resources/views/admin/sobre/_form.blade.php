@if ($errors->any())
    <p class="error">Campos com * são obrigatórios!</p>
@endif
<input type="hidden" name="user_id" value="{{ Auth::id() }}">
<h3>Informações do site</h3>
<div class="input-field">
    <label for="titulo_site">Titulo do site*</label>
    <input class="{{ $errors->has('titulo_site') ? 'error' : '' }}" type="text" name="titulo_site" value="{{ isset($registro->titulo_site) ? $registro->titulo_site : old('titulo_site') }}" placeholder="Digite aqui o titulo do site">
    @error('titulo_site')
        <p class="error">{{ $message }}</p>
    @enderror
</div>
<div class="input-field">
    <label for="slogan">Slogan*</label>
    <input class="{{ $errors->has('slogan') ? 'error' : '' }}" type="text" name="slogan" value="{{ isset($registro->slogan) ? $registro->slogan : old('slogan') }}" placeholder="Digite aqui o slogan do site">
    @error('slogan')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div class="input-field">
    <label for="logo">Logo do site*</label>
    <input class="{{ $errors->has('logo') ? 'error' : '' }}" type="file" name="logo">
    @error('logo')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

@if(@isset($registro->logo))
    <div class="input-field">
        <img src="{{ asset($registro->logo) }}" alt="">
    </div>    
@endisset

<div class="input-field">
    <label for="banner">Banner do site</label>
    <input class="{{ $errors->has('banner') ? 'error' : '' }}" type="file" name="banner">
    @error('banner')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

@if(@isset($registro->banner))
    <div class="input-field">
        <img src="{{ asset($registro->banner) }}" alt="">
    </div>    
@endisset

<h3>Informações da organização</h3>
<div class="input-field">
    <label for="texto_sobre">Texto sobre a organização*</label>
    <textarea id="summernote" type="text" name="texto_sobre" placeholder="Escreve aqui um texto sobre a organização">{{ isset($registro->texto_sobre) ? $registro->texto_sobre : old('texto_sobre') }}</textarea>
    @error('texto_sobre')
        <p class="error">{{ $message }}</p>
    @enderror
</div>
<div class="input-field">
    <label for="email">Email da organização*</label>
    <input class="{{ $errors->has('email') ? 'error' : '' }}" type="text" name="email" value="{{ isset($registro->email) ? $registro->email : old('email') }}" placeholder="Digite aqui o email da organização">
    @error('email')
        <p class="error">{{ $message }}</p>
    @enderror
</div>
<div class="input-field">
    <label for="telefone">Telefone para contato da organização</label>
    <input class="{{ $errors->has('telefone') ? 'error' : '' }}" type="text" name="telefone" value="{{ isset($registro->telefone) ? $registro->telefone : old('telefone') }}" placeholder="Digite aqui o telefone da organização">
    @error('telefone')
        <p class="error">{{ $message }}</p>
    @enderror
</div>
<div class="input-field">
    <label for="anexo_sobre">Anexo do sobre</label>
    <input class="{{ $errors->has('anexo_sobre') ? 'error' : '' }}" type="file" name="anexo_sobre">
    @error('anexo_sobre')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

@if(@isset($registro->anexo_sobre))
    <div class="input-field">
        <img src="{{ asset($registro->anexo_sobre) }}" alt="">
    </div>    
@endisset

<h3>Redes sociais</h3>
<div class="input-field">
    <label for="instagram">Instagram</label>
    <input type="text" name="instagram" value="{{ isset($registro->instagram) ? $registro->instagram : old('instagram') }}" placeholder="Digite aqui o instagram da organização">
    @error('instagram')
        <p class="error">{{ $message }}</p>
    @enderror
</div>
<div class="input-field">
    <label for="twitter">Twitter</label>
    <input type="text" name="twitter" value="{{ isset($registro->twitter) ? $registro->twitter : old('twitter') }}" placeholder="Digite aqui o twitter da organização">
    @error('twitter')
        <p class="error">{{ $message }}</p>
    @enderror
</div>
<div class="input-field">
    <label for="facebook">Facebook</label>
    <input type="text" name="facebook" value="{{ isset($registro->facebook) ? $registro->facebook : old('facebook') }}" placeholder="Digite aqui o facebook da organização">
    @error('facebook')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

