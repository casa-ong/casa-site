<input type="hidden" name="user_id" value="{{ Auth::id() }}">


<div class="input-field">
    <label>Escolha o método de pagamento:</label>
    <div class="radio-doacao">
        <label class="radio-option-doacao">
            <input type="radio" name="meio_pagamento" value="deposito_transferencia">
            <p>Depósito ou Transferência Bancária</p>
           
            @if(isset($contaPagamentos))
                <ul>
                    <li><b>Nome:</b> {{ $contaPagamentos->nome }}</li>
                    <li><b>CNPJ:</b> {{ $contaPagamentos->cnpj }}</li>
                    <li><b>Banco:</b> {{ $contaPagamentos->banco }}</li>
                    <li><b>Agência:</b> {{ $contaPagamentos->agencia }}</li>
                    <li><b>Operação:</b> {{ $contaPagamentos->operacao }}</li>
                    <li><b>N° da Conta:</b> {{ $contaPagamentos->numero_conta }}</li>
                </ul>
            @else
                <p>Conta bancária indisponível.</p>
            @endif
        </label>

        <div>
        </div>

        <label class="radio-option-doacao">
            <input disabled type="radio" name="meio_pagamento" value="boleto">
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
            <input id="is_anonimo" type="radio" name="is_anonimo" value="1">
            <p>Anônimo</p>
        </label>

        <label class="radio-option-doacao">
            <input id="is_identified" type="radio" name="is_anonimo" value="0">
            <p>Identificar</p>
        </label>
    </div>
    @error('is_anonimo')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>

<div id="nome" class="input-field">
    <label>Nome ou Apelido:</label>
    <input  {{ isset($registro->nome) ? 'readonly' : ''}} type="text" name="nome" value="{{ isset($registro->nome) ? $registro->nome : old('nome') }}">
    @error('nome')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
   
        @if(isset($registro->comprovante_anexo))
            <a class="btn" href="{{ asset($registro->comprovante_anexo) }}" alt="" download="baixar">Baixar anexo</a>
        @else
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
