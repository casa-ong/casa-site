@php
    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
@endphp

@if ($errors->any())
    <p class="error">Campos com * são obrigatórios!</p>
@endif
@if(Session::has('success'))
    <div class="alert alert-success" onclick="$(this).toggle('hide')">
        <p>{{ Session::get('success') }}</p>
    </div>
@endif
<p><strong>Atualizado pela última vez na {{ strftime('%A, %d de %B  de %Y', strtotime($registro->updated_at)) }}</strong></p>
<div class="input-field">
    <label for="nome">Nome*</label>
    <input type="text" name="nome" value="{{ isset($registro->nome) ? $registro->nome : old('nome') }}" placeholder="Digite aqui o nome que está na Conta">
    @error('nome')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="input-field">
    <label for="cnpj">CNPJ*</label>
    <input type="text" name="cnpj" value="{{ isset($registro->cnpj) ? $registro->cnpj : old('cnpj') }}" placeholder="Digite aqui o cnpj da Conta">
    @error('cnpj')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="input-field">
    <label for="banco">Banco*</label>
    <input type="text" name="banco" value="{{ isset($registro->banco) ? $registro->banco : old('banco') }}" placeholder="Digite aqui o nome do banco">
    @error('bancoS')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="input-field">
    <label for="agencia">Agência*</label>
    <input type="text" name="agencia" value="{{ isset($registro->agencia) ? $registro->agencia : old('agencia') }}" placeholder="Digite aqui o número da agência">
    @error('agencia')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="input-field">
    <label for="operacao">Operação*</label>
    <input type="text" name="operacao" value="{{ isset($registro->operacao) ? $registro->operacao : old('operacao') }}" placeholder="Digite aqui o número da operação que corresponde a conta">
    @error('operacao')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="input-field">
    <label for="numero_conta">Número da Conta*</label>
    <input type="text" name="numero_conta" value="{{ isset($registro->numero_conta) ? $registro->numero_conta : old('numero_conta') }}" placeholder="Digite aqui o número da Conta">
    @error('numero_conta')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>