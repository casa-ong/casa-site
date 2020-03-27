<input type="hidden" name="user_id" value="{{ Auth::id() }}">

<div class="input-field">
    <label for="titulo">Titulo do site</label>
    <input type="text" name="titulo" value="{{ isset($registro->titulo) ? $registro->titulo : '' }}" placeholder="Digite aqui o titulo do site">
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