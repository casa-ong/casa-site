@extends('layout.site')
@section('titulo', 'Prestação de Conta | Casa')


@php
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
@endphp

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1>Doação recebida</h1>
        </div>
        <div>
            <div class="action">
                <p>
                    Foi doado <strong>R$ {{$registro->valor}} </strong> por <strong>{{$registro->is_anonimo ? 'Anônimo' : $registro->nome}}</strong>
                    usando o meio de pagamento <strong>{{$registro->meio_pagamento === 'deposito_transferencia' ? 'depósito ou transferência' :  $registro->meio_pagamento}}</strong> no dia <strong>{{ strftime('%d de %B  de %Y', strtotime($registro->created_at)) }}</strong>.
                </p>
            </div>
        </div>
        <div class="input-field">
            <label for="nota_fiscal" class="input">
                <div class="banner-preview">
                    <span class="fas fa-image"></span>
                    <img class="{{ isset($registro->comprovante_anexo) ? 'img-zoomable' : '' }}" id="nota-fiscal" src="{{ isset($registro->comprovante_anexo) ? asset($registro->comprovante_anexo) : '' }}" alt="">                   
                    <div style="display: none; background: url('{{ isset($registro->comprovante_anexo) ? asset($registro->comprovante_anexo) : '' }}'); background-size: contain" alt=""></div>
                    <p>Comprovante de transação</p>
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

{{-- Overlay para mostrar imagens aumentadas --}}
<div class="overlay"></div>
@endsection

@section('scripts')

    <script>
        // Image to Lightbox Overlay 
        let image = document.querySelector(".img-zoomable");
        let overlay = document.querySelector(".overlay");

        image.addEventListener("click", function() {
            overlay.style.backgroundImage = document.querySelector(".img-zoomable ~ div").style.backgroundImage;
            overlay.classList.toggle("open");
        });

        overlay.addEventListener("click", function() {
            overlay.classList.toggle("open"); 
        });

        let floatingEnquete = document.querySelector(".floating");
        let header = document.querySelector(".floating-header")
        if(floatingEnquete && header) {
            header.addEventListener("click", function() {
                floatingEnquete.classList.toggle("show");
            });
        }
        
    </script>

@endsection