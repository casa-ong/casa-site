<input type="hidden" name="user_id" value="{{ Auth::id() }}">

@if(isset($registro))
    <p>Esse evento está <strong>{{ isset($registro->publicado) && $registro->publicado == true ? 'publicado' : 'salvo no rascunho'}}.</strong></p>
@endif

<div class="input-field">
    <label for="nome">Nome*</label>
    <input class="{{ $errors->has('nome') ? 'error' : '' }}" type="text" name="nome" value="{{ isset($registro->nome) ? $registro->nome : old('nome') }}" placeholder="Digite aqui o nome do evento">
    @error('nome')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="input-field">
    <label for="nome">Descrição*</label>
    <textarea id="summernote" class="{{ $errors->has('descricao') ? 'error' : '' }}" type="text" name="descricao" placeholder="Descreva aqui como será o evento">{{ isset($registro->descricao) ? $registro->descricao : old('descricao') }}</textarea>
    @error('descricao')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="input-field">
    <label for="nome">Banner do evento</label>
    <input type="file" class="{{ $errors->has('anexo') ? 'error' : '' }}" name="anexo" onchange="document.getElementById('img-banner').src = window.URL.createObjectURL(this.files[0])">
    @error('anexo')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="input-field">
    <img id="img-banner" src="{{ isset($registro->anexo) ? asset($registro->anexo) : '' }}" alt="">
</div>    

<div class="input-field">
    <label for="nome">Data</label>
    <div class="input-field datetime">
        <input type="date" name="data" value="{{ isset($registro->data) ? $registro->data : '' }}" placeholder="Digite a data do evento">
        <input type="time" name="hora" value="{{ isset($registro->hora) ? date('H:i', strtotime($registro->hora)) : '' }}" placeholder="Digite a hora do evento">
    </div>
</div>