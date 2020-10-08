<input type="hidden" name="user_id" value="{{ Auth::id() }}">


<div class="input-field">
    <label>Escolha o método de pagamento:</label>
    <div class="radio-doacao">
        <label class="radio-option-doacao">
            <input type="radio" name="meio_pagamento" value="deposito_transferencia">
            <p>Depósito ou Transferência Bancária</p>
            
            <ul>
                <li><b>Nome:</b> {{ $contaPagamentos->nome }}</li>
                <li><b>CNPJ:</b> {{ $contaPagamentos->cnpj }}</li>
                <li><b>Banco:</b> {{ $contaPagamentos->banco }}</li>
                <li><b>Agência:</b> {{ $contaPagamentos->agencia }}</li>
                <li><b>Operação:</b> {{ $contaPagamentos->operacao }}</li>
                <li><b>N° da Conta:</b> {{ $contaPagamentos->numero_conta }}</li>
            </ul>
        </label>

        <div>
        </div>

        <label class="radio-option-doacao">
            <input type="radio" name="meio_pagamento" value="boleto">
            <p>Boleto Bancário</p>
        </label>
    </div>
    @error('meio_pagamento')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="input-field">
    <label>Escolha o valor da doação:</label>
    <input type="number" name="valor" value="{{ old ('valor') }}">
    @error('valor')
    <span class="invalid-feedback" role="alert">
        {{ $message }}
    </span>
@enderror
</div>

<div class="input-field">
    <label>Identificação:</label>
    <div class="radio-doacao">
        <label class="radio-option-doacao">
            <input type="radio" name="is_anonimo" value="1">
            <p>Anônimo</p>
        </label>

        <label class="radio-option-doacao">
            <input type="radio" name="is_anonimo" value="0">
            <p>Identificar</p>
        </label>
    </div>
    @error('is_anonimo')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="input-field">
    <label>Nome ou Apelido:</label>
    <input type="text" name="nome" value="{{ old ('nome') }}">
</div>


<div class="input-field">
    <label>Anexo Comprovante:</label>
    <input type="file" name="comprovante_anexo">
    @error('comprovante_anexo')
    <span class="invalid-feedback" role="alert">
        {{ $message }}
    </span>
@enderror
</div>