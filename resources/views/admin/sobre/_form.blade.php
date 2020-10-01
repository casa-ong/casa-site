@if ($errors->any())
    <p class="error">Campos com * são obrigatórios!</p>
@endif
@if(Session::has('success'))
    <div class="alert alert-success" onclick="$(this).toggle('hide')">
        <p>{{ Session::get('success') }}</p>
    </div>
@endif

<input type="hidden" name="user_id" value="{{ Auth::id() }}">
<h3>Informações do site</h3>
<div class="input-field">
    <label for="titulo_site">Titulo do site</label>
    <input class="{{ $errors->has('titulo_site') ? 'error' : '' }}" type="text" name="titulo_site" value="{{ isset($registro->titulo_site) ? $registro->titulo_site : old('titulo_site') }}" placeholder="Digite aqui o titulo do site">
    @error('titulo_site')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="input-field">
    <label for="logo">Ícone do site</label>
    <div class="input-field row">
        <input class="{{ $errors->has('logo') ? 'error' : '' }}" type="file" name="logo" onchange="document.getElementById('img-logo').src = window.URL.createObjectURL(this.files[0])">
        <img id="img-logo" src="{{ isset($registro->logo) ? asset($registro->logo) : '' }}" alt="" style="border: 1px solid rgba(0, 0, 0, 0.2); border-radius: 5px;">
    </div>    
    @error('logo')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>


<div class="input-field">
    <label for="banner">Banner do site</label>
    <input class="{{ $errors->has('banner') ? 'error' : '' }}" type="file" name="banner" onchange="document.getElementById('img-banner').src = window.URL.createObjectURL(this.files[0])">
    @error('banner')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="input-field">
    <img id="img-banner" src="{{ isset($registro->banner) ? asset($registro->banner) : '' }}" alt="">
</div>    

<h3>Informações da organização</h3>
<div class="input-field">
    <label for="texto_sobre">Nossa missão</label>
    <textarea id="summernote" type="text" name="texto_sobre" placeholder="Escreve aqui um texto sobre a organização">{{ isset($registro->texto_sobre) ? $registro->texto_sobre : old('texto_sobre') }}</textarea>
    @error('texto_sobre')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="input-field">
    <label for="email">E-mail da organização</label>
    <input class="{{ $errors->has('email') ? 'error' : '' }}" type="text" name="email" value="{{ isset($contato->email) ? $contato->email : old('email') }}" placeholder="Digite aqui o email da organização">
    @error('email')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="input-field">
    <label for="telefone">Telefone para contato da organização</label>
    <input class="{{ $errors->has('telefone') ? 'error' : '' }} telefone" type="text" name="telefone" value="{{ isset($contato->telefone) ? $contato->telefone : old('telefone') }}" placeholder="Digite aqui o telefone da organização">
    @error('telefone')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>

<h3>Redes sociais</h3>
<div class="input-field">
    <label for="instagram">Instagram</label>
    <input type="url" name="instagram" value="{{ isset($contato->instagram) ? $contato->instagram : old('instagram') }}" placeholder="Digite aqui o instagram da organização">
    @error('instagran')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="input-field">
    <label for="twitter">Twitter</label>
    <input type="url" name="twitter" value="{{ isset($contato->twitter) ? $contato->twitter : old('twitter') }}" placeholder="Digite aqui o twitter da organização">
    @error('twitter')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="input-field">
    <label for="facebook">Facebook</label>
    <input type="url" name="facebook" value="{{ isset($contato->facebook) ? $contato->facebook : old('facebook') }}" placeholder="Digite aqui o facebook da organização">
    @error('facebook')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>