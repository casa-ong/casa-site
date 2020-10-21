@extends('layout.site')
@section('titulo', 'Prestação de Conta | Casa')


@php
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
@endphp

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1>Prestação de Conta</h1>
        </div>
        <div>
            <div class="action text-center">
                <a type="text" name="descricao" placeholder="Descrição">Foi doado <strong>{{$registro->valor}} </strong> reais por {{$registro->is_anonimo ? 'Anônimo' : $registro->nome}}
                    usando {{$registro->meio_pagamento === 'deposito_transferencia' ? 'depósito ou transferência' :  $registro->meio_pagamento}} no dia {{ strftime('%d de %B  de %Y', strtotime($registro->created_at)) }}.</a>
            </div>
        </div>
        <div class="input-field">
            <label for="nota_fiscal" class="input">Comprovante
                <div class="banner-preview">
                    <span class="fas fa-image"></span>
                    <img id="nota-fiscal" src="{{ isset($registro->comprovante_anexo) ? asset($registro->comprovante_anexo) : '' }}" alt="">                   
                </div>
            </label>
            @error('nota_fiscal')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>
</div>
@endsection