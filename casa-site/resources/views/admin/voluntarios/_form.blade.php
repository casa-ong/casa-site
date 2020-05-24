@if ($errors->any())
    <p class="error">Confire novamente os campos em vermelho</p>
@endif
<div class="input-field">
    <label for="name">Nome*</label>
    <input class="{{ $errors->has('name') ? 'error' : '' }}" type="text" name="name" value="{{ isset($registro->name) ? $registro->name : old('name') }}" placeholder="Digite aqui seu nome">

    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>

    @enderror
</div>
<div class="input-field">
    <label for="cpf">CPF*</label>
    <input {{ isset($registro->cpf) ? "readonly" : ""  }} class="{{ $errors->has('cpf') ? 'error' : '' }} cpf " type="text" name="cpf" value="{{ isset($registro->cpf) ? $registro->cpf : old('cpf') }}" placeholder="Digite aqui seu cpf">
    @error('cpf')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="input-field">
    <label for="nascimento">Data de nascimento</label>
    <input class="{{ $errors->has('nascimento') ? 'error' : '' }}" type="date" name="nascimento" value="{{ isset($registro->cpf) ? $registro->nascimento : old('nascimento') }}" placeholder="Digite aqui sua data de nascimento">
    @error('nascimento')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="input-field">
    <label for="profissao">Profissão*</label>
    <input class="{{ $errors->has('profissao') ? 'error' : '' }}" type="text" name="profissao" value="{{ isset($registro->profissao) ? $registro->profissao : old('profissao') }}" placeholder="Digite aqui sua profissão">
    @error('profissao')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>       
    @enderror
</div>
<div class="input-field">
    <label for="estado">Estado*</label>
    <select class="{{ $errors->has('estado') ? 'error' : '' }}" name="estado" id="estados">
        <option selected value>{{ __('Selecione um estado') }}</option>
        @foreach ($estados as $estado)
            @if( isset($registro->estado) && $estado[0] == $registro->estado)
                <option selected value="{{ $estado[0] }}">{{ $estado[1] }}</option>
            @endif
            <option value="{{ $estado[0] }}">{{ $estado[1] }}</option>
        @endforeach
    </select>
    @error('estado')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>
<div class="input-field">
    <label for="cidade">Cidade</label>
    <input class="{{ $errors->has('cidade') ? 'error' : '' }}" type="text" name="cidade" value="{{ isset($registro->cidade) ? $registro->cidade : old('cidade') }}" placeholder="Digite aqui o nome da sua cidade">
    @error('cidade')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>       
    @enderror
</div>
<div class="input-field">
    <label for="descricao">Descrição*</label>
    <textarea class="{{ $errors->has('descricao') ? 'error' : '' }}" type="text" name="descricao" placeholder="Descreva você mesmo">{{ isset($registro->descricao) ? $registro->descricao : old('descricao') }}</textarea>
    @error('descricao')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="input-field">
    <label for="projeto_id">Projeto</label>
    <select class="{{ $errors->has('projeto_id') ? 'error' : '' }}" name="projeto_id">
        <option hidden disabled selected value>{{ __('Selecione um projeto') }}</option>
        <option value>{{ __('Nenhum') }}</option>
        @foreach ($projetos as $projeto)
            @if(isset($registro->projeto_id) && $projeto->id == $registro->projeto_id)
                <option selected value="{{ $projeto->id }}">{{ $projeto->nome }}</option>
            @endif
            <option value="{{ $projeto->id }}">{{ $projeto->nome }}</option>
        @endforeach
    </select>
    @error('projeto_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>    
    @enderror
</div>
<div class="input-field">
    <label for="foto">Foto do voluntario (quadrada, 1x1)</label>
    <div class="input-field row">
        <input class="{{ $errors->has('foto') ? 'error' : '' }}" type="file" name="foto" onchange="document.getElementById('img-foto').src = window.URL.createObjectURL(this.files[0])">
        <img id="img-foto" src="{{ isset($registro->foto) ? asset($registro->foto) : asset('/img/voluntarios/user_profile.png') }}" alt="" style="border: 1px solid rgba(0, 0, 0, 0.2); border-radius: 5px;">
    </div>    
    @error('foto')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="input-field">
    <label for="email">Email*</label>
    <input {{ isset($registro->email) ? "readonly" : ""  }} class="{{ $errors->has('email') ? 'error' : '' }}" type="text" name="email" value="{{ isset($registro->email) ? $registro->email : old('email') }}" placeholder="Digite aqui seu email">
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

</div>
<div class="input-field">
    <label for="telefone">Telefone/Celular*</label>
    <input class="{{ $errors->has('telefone') ? 'error' : '' }} telefone" type="text" name="telefone" value="{{ isset($registro->telefone) ? $registro->telefone : old('telefone') }}" placeholder="Digite aqui seu telefone">
    @error('telefone')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
