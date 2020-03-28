<input type="hidden" name="user_id" value="{{ Auth::id() }}">
<h3>Informações do site</h3>
<div class="input-field">
    <label for="titulo_site">Titulo do site</label>
    <input type="text" name="titulo_site" value="{{ isset($registro->titulo_site) ? $registro->titulo_site : '' }}" placeholder="Digite aqui o titulo do site">
</div>
<div class="input-field">
    <label for="slogan">Slogan</label>
    <input type="text" name="slogan" value="{{ isset($registro->slogan) ? $registro->slogan : '' }}" placeholder="Digite aqui o slogan do site">
</div>

<div class="input-field">
    <label for="logo">Logo do site</label>
    <input type="file" name="logo">
</div>

@if(@isset($registro->logo))
    <div class="input-field">
        <img src="{{ asset($registro->logo) }}" alt="">
    </div>    
@endisset

<div class="input-field">
    <label for="logo">Banner do site</label>
    <input type="file" name="banner">
</div>

@if(@isset($registro->banner))
    <div class="input-field">
        <img src="{{ asset($registro->banner) }}" alt="">
    </div>    
@endisset

<h3>Informações da organização</h3>
<div class="input-field">
    <label for="titulo_sobre">Titulo do texto sobre a organização</label>
    <input type="text" name="titulo_sobre" value="{{ isset($registro->titulo_sobre) ? $registro->titulo_sobre : '' }}" placeholder="Digite aqui o titulo do texto">
</div>
<div class="input-field">
    <label for="texto_sobre">Texto sobre a organização</label>
    <textarea type="text" name="texto_sobre" placeholder="Escreve aqui um texto sobre a organização">{{ isset($registro->texto_sobre) ? $registro->texto_sobre : '' }}</textarea>
</div>
<div class="input-field">
    <label for="email">Email da organização</label>
    <input type="text" name="email" value="{{ isset($registro->email) ? $registro->email : '' }}" placeholder="Digite aqui o email da organização">
</div>
<div class="input-field">
    <label for="telefone">Telefone para contato da organização</label>
    <input type="text" name="telefone" value="{{ isset($registro->telefone) ? $registro->telefone : '' }}" placeholder="Digite aqui o telefone da organização">
</div>
<div class="input-field">
    <label for="anexo_sobre">Anexo do sobre</label>
    <input type="file" name="anexo_sobre">
</div>

@if(@isset($registro->anexo_sobre))
    <div class="input-field">
        <img src="{{ asset($registro->anexo_sobre) }}" alt="">
    </div>    
@endisset

<h3>Redes sociais</h3>
<div class="input-field">
    <label for="instagram">Instagram</label>
    <input type="text" name="instagram" value="{{ isset($registro->instagram) ? $registro->instagram : '' }}" placeholder="Digite aqui o instagram da organização">
</div>
<div class="input-field">
    <label for="twitter">Twitter</label>
    <input type="text" name="twitter" value="{{ isset($registro->twitter) ? $registro->twitter : '' }}" placeholder="Digite aqui o twitter da organização">
</div>
<div class="input-field">
    <label for="facebook">Facebook</label>
    <input type="text" name="facebook" value="{{ isset($registro->facebook) ? $registro->facebook : '' }}" placeholder="Digite aqui o facebook da organização">
</div>

