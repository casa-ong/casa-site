<div class="input-field">
    <label for="nome">Email</label>
    <input class="{{ $errors->has('email') ? 'error' : '' }}" type="text" name="email" value="{{ isset($registro->email) ? $registro->email : '' }}">
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<label class="input-checkbox" for="receber_eventos">Receber notificação dos Eventos?
    <input type="checkbox" name="receber_eventos" {{ isset($registro->receber_eventos) && $registro->receber_eventos == true ? 'checked' : ''}} value="true">
    <span class="checkmark"></span>
</label>

<label class="input-checkbox" for="receber_projetos">Receber notificação dos Projetos?
    <input type="checkbox" name="receber_projetos" {{ isset($registro->receber_projetos) && $registro->receber_projetos == true ? 'checked' : ''}} value="true">
    <span class="checkmark"></span>
</label>

<label class="input-checkbox" for="receber_noticias">Receber notificação das Notícias?
    <input type="checkbox" name="receber_noticias" {{ isset($registro->receber_noticias) && $registro->receber_noticias == true ? 'checked' : ''}} value="true">
    <span class="checkmark"></span>
</label>
