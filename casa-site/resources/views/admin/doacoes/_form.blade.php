<input type="hidden" name="user_id" value="{{ Auth::id() }}">

<div class="input-field">
    <label>Escolha o método de pagamento:</label>
    <div class="radio-doacao">
        <label class="radio-option-doacao">
            <input type="radio" name="meio_pagamento" value="deposito_transferencia" {{ isset($registro->meio_pagamento) ? ($registro->meio_pagamento == 'deposito_transferencia' ? 'checked' : 'disabled') : (old('meio_pagamento') == 'deposito_transferencia' ? 'checked' : '') }}>
            <p>Depósito ou Transferência Bancária</p>
           
            @if(isset($contaPagamentos) || isset($registro->conta_pagamento))
                <ul>
                    <li><b>Nome:</b> {{ $contaPagamentos->nome ?? $registro->conta_pagamento->nome }}</li>
                    <li><b>CNPJ:</b> {{ $contaPagamentos->cnpj ?? $registro->conta_pagamento->cnpj }}</li>
                    <li><b>Banco:</b> {{ $contaPagamentos->banco ?? $registro->conta_pagamento->banco }}</li>
                    <li><b>Agência:</b> {{ $contaPagamentos->agencia ?? $registro->conta_pagamento->agencia }}</li>
                    <li><b>Operação:</b> {{ $contaPagamentos->operacao ?? $registro->conta_pagamento->operacao }}</li>
                    <li><b>N° da Conta:</b> {{ $contaPagamentos->numero_conta ?? $registro->conta_pagamento->numero_conta }}</li>
                </ul>
            @else
                <p>Conta bancária indisponível.</p>
            @endif
        </label>

        <div>
        </div>

        <label class="radio-option-doacao">
            <input disabled type="radio" name="meio_pagamento" value="boleto"  {{ isset($registro->meio_pagamento) ? ($registro->meio_pagamento == 'boleto' ? 'checked' : 'disabled') : (old('meio_pagamento') == 'boleto' ? 'checked' : '') }}>
            <p>Boleto Bancário</p>
            <h4>Indisponível</h4>
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
    <input {{ isset($registro->valor) ? 'readonly' : ''}} type="number" step="any" name="valor" value="{{ isset($registro->valor) ? $registro->valor : old('valor') }}">
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
            <input id="is_anonimo" type="radio" name="is_anonimo" value="1" {{ isset($registro->is_anonimo) ? ($registro->is_anonimo ? 'checked' : 'disabled') : (old('is_anonimo') ? 'checked' : '') }}>
            <p>Anônimo</p>
        </label>

        <label class="radio-option-doacao">
            <input id="is_identified" type="radio" name="is_anonimo" value="0" {{ isset($registro->is_anonimo) ? ($registro->is_anonimo ? 'disabled' : 'checked') : (old('is_anonimo') ? '' : 'checked') }}>
            <p>Identificar</p>
        </label>
    </div>
    @error('is_anonimo')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>

@if(!isset($registro->is_anonimo) || !$registro->is_anonimo)
    <div id="nome" class="input-field {{ old('is_anonimo') ? 'hide' : '' }}">
        <label>Nome ou Apelido:</label>
        <input  {{ isset($registro->nome) ? 'readonly' : ''}} type="text" name="nome" value="{{ isset($registro->nome) ? $registro->nome : old('nome') }}">
        @error('nome')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
@endif

@if(!isset($registro->comprovante_anexo))
    <div class="input-field">
        <label>Anexo Comprovante:</label>
        <input type="file" name="comprovante_anexo">
        @error('comprovante_anexo')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    
    </div>
@endif  

@section('scripts')

    <script>
        let anonimo = document.getElementById('is_anonimo');
        anonimo.onchange = function(){
            let nome = document.getElementById('nome');
            if(nome && anonimo.checked){
                nome.classList = 'input-field hide';
            }
        };

        let identified = document.getElementById('is_identified');
        identified.onchange = function(){
            let nome = document.getElementById('nome');
            if(nome && identified.checked){
                nome.classList = 'input-field';
            }
        };
    </script>
    
@endsection
