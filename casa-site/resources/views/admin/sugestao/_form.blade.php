@if ($errors->any())
    <p class="error">Campos com * são obrigatórios!</p>
@endif
<input type="hidden" name="user_id" value="{{ Auth::id() }}">
<input type="checkbox" name="lida" value="true" style="display: none;">

<div class="input-field">
    <label for="assunto">Assunto*</label>
    <input {{ isset($registro->assunto) ? 'readonly' : ''}} class="{{ $errors->has('assunto') ? 'error' : '' }}" type="text" name="assunto" value="{{ isset($registro->assunto) ? $registro->assunto : old('assunto') }}" placeholder="Digite aqui o assunto da sugestão">
    @error('assunto')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="input-field">
    <label for="mensagem">Mensagem*</label>
    <textarea {{ isset($registro->mensagem) ? 'readonly' : ''}} class="{{ $errors->has('mensagem') ? 'error' : '' }}" type="text" name="mensagem" placeholder="Descreva aqui sua sugestão">{{ isset($registro->mensagem) ? $registro->mensagem : old('mensagem') }}</textarea>
    @error('mensagem')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="input-field">
    <label for="email">Email*</label>
    <input {{ isset($registro->email) ? 'readonly' : ''}} class="{{ $errors->has('email') ? 'error' : '' }}" type="text" name="email" value="{{ isset($registro->email) ? $registro->email : old('email') }}" placeholder="Digite aqui o seu email">
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="input-field">
    <label for="telefone">Celular/whatsapp*</label>
    <input {{ isset($registro->telefone) ? 'readonly' : ''}} class="{{ $errors->has('telefone') ? 'error' : '' }} telefone" type="text" name="telefone" value="{{ isset($registro->telefone) ? $registro->telefone : old('telefone') }}" placeholder="Digite aqui o seu número do celular">
    @error('telefone')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
