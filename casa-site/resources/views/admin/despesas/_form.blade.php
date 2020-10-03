<input type="hidden" name="user_id" value="{{Auth::id()}}">
@if(isset($registro))
<p>Essa despesa está <strong>{{ isset($registro->publicado) && $registro->publicado == true ? 'publicado' : 'salvo no rascunho'}}.</strong></p>
@endif

<div class="input-field">
    <label for="nome">Nome*</label>
    <input class="{{ $errors->has('nome') ? 'error' : '' }}" type="text" name="nome" value="{{ isset($registro->nome) ? $registro->nome : old('nome') }}" placeholder="Digite aqui o nome do projeto">
    @error('nome')
    <span class="invalid-feedback" role="alert">
        {{ $message }}
    </span>
    @enderror
</div>
<div class="input-field">
    <label for="descricao">Descrição*</label>
    <textarea class="{{ $errors->has('descricao') ? 'error' : '' }}" type="text" name="descricao" placeholder="Descreva o projeto">{{ isset($registro->descricao) ? $registro->descricao : old('descricao') }}</textarea>
    @error('descricao')
    <span class="invalid-feedback" role="alert">
        {{ $message }}
    </span>
    @enderror
</div>
<div class="input-field">
    <label for="valor">Valor*</label>
    <input class="{{ $errors->has('valor') ? 'error' : '' }}" type="text" name="valor" value="{{ isset($registro->valor) ? $registro->valor : old('valor') }}" placeholder="Digite aqui o valor da despesa">
    @error('valor')
    <span class="invalid-feedback" role="alert">
        {{ $message }}
    </span>
    @enderror
</div>
<div class="input-field">
    <label for="nota_fiscal" class="input">Nota fiscal
        <div class="banner-preview">
            <span class="fas fa-image"></span>
            <img id="nota-fiscal" src="{{ isset($registro->nota_fiscal) ? asset($registro->nota_fiscal) : '' }}" alt="">
            <p>Escolher uma imagem jpeg, png, bmp, svg, webp <br>ou um pdf</p>
        </div>
        <input type="file" class="{{ $errors->has('nota_fiscal') ? 'error' : '' }}" id="nota_fiscal" name="nota_fiscal" onchange="document.getElementById('nota-fiscal').src = window.URL.createObjectURL(this.files[0])">
    </label>
    @error('nota_fiscal')
    <span class="invalid-feedback" role="alert">
        {{ $message }}
    </span>
    @enderror
</div>