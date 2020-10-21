@extends('layout.site')
@section('titulo', 'Prestação de Conta | Casa')


@php
    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    $user = App\Models\User::find($registro->user_id);
@endphp

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1>Despesa registrada</h1>
        </div>
        <div>
            <div class="action">
                <p>
                    Foi gasto <strong>R$ {{$registro->valor}}</strong> em <strong>{{strtolower($registro->nome ?? ' ')}}</strong>
                    declarado por <strong>{{ $user->name}}</strong> no dia <strong>{{ strftime('%d de %B  de %Y', strtotime($registro->created_at)) }}</strong>, 
                    na descrição do gasto escreveu <strong>"{{$registro->descricao}}"</strong>.
                </p>
            </div>
        </div>
        <div class="input-field">
            <label for="nota_fiscal" class="input">
                <div class="banner-preview">
                    <span class="fas fa-image"></span>
                    <img class="{{ isset($registro->nota_fiscal) ? 'img-zoomable' : '' }}" id="nota-fiscal" src="{{ isset($registro->nota_fiscal) ? asset($registro->nota_fiscal) : '' }}" alt="">                   
                    <div style="display: none; background: url('{{ isset($registro->nota_fiscal) ? asset($registro->nota_fiscal) : '' }}'); background-size: contain" alt=""></div>
                    <p>Nota fiscal da despesa</p>
                </div>
            </label>
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