@if ($errors->any())
    <p class="error">Campos com * são obrigatórios!</p>
@endif
<input type="hidden" name="user_id" value="{{ Auth::id() }}">
<div class="input-field">
    <label for="nome">Nome*</label>
    <input class="{{ $errors->has('nome') ? 'error' : '' }}" type="text" name="nome" value="{{ isset($registro->nome) ? $registro->nome : old('nome') }}" placeholder="Digite aqui o nome do evento">
    @error('nome')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="input-field">
    <label for="nome">Descrição*</label>
    <textarea class="{{ $errors->has('descricao') ? 'error' : '' }}" type="text" name="descricao" placeholder="Descreva aqui como será o evento">{{ isset($registro->descricao) ? $registro->descricao : old('descricao') }}</textarea>
    @error('descricao')
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

<div class="input-field">
    <label for="nome">Data</label>
    <input type="date" name="data" value="{{ isset($registro->data) ? $registro->data : '' }}" placeholder="Digite a data do evento">
</div>

<label class="input-checkbox" for="publicado">Publicar agora?
    <input type="checkbox" name="publicado" {{ isset($registro->publicado) && $registro->publicado == true ? 'checked' : ''}} value="true">
    <span class="checkmark"></span>
</label>

