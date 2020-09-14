<!DOCTYPE html>

@php
    $sobre = App\Sobre::latest('updated_at')->first();
    if($sobre != null) {
        $titulo = $sobre->titulo_site;
        $slogan = $sobre->slogan;
        $logo = $sobre->logo;
        $banner = $sobre->banner;
    }
@endphp

<html lang="pt-br">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('titulo')</title>
        
        <!-- Estilo da pagina -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
        <!-- JavaScript da pagina -->
        <script src="{{ asset('js/dropdown_on_click.js') }}" crossorigin="anonymous"></script>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ isset($sobre->logo) ? asset($sobre->logo) : asset('img/logos/casa-marca.png') }}">
        
        <!-- Icones do Font Awesome -->
        <script src="https://kit.fontawesome.com/8eafe50798.js" defer crossorigin="anonymous"></script>

        <!-- Font monterrat regular -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet"> 
        
        <!-- include summernote css/js -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.css" rel="stylesheet">
        <script defer src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.js"></script>

        <!-- include Flickty for carousel/slider -->
        <script src="{{ asset('js/flickity.pkgd.min.js') }}"></script>        
        <link rel="stylesheet" href="{{ asset('css/flickity.css') }}">

        <!-- Mascaras -->
        <script defer src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
        <script src="{{ asset('js/jquery/jquery.inputmask.js') }}"></script>      
        <script src="{{ asset('js/jquery/jquery.maskMoney.min.js') }}"></script>
        <script src="{{ asset('js/masks.js') }}"></script>
        <!-- reCAPTCHA-->
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>

    <body>
        <header>
            <div class="header">
                <img class="banner" src="{{ isset($banner) ? asset($banner) : asset('img/banner/casa-banner.png') }}" alt="{{ $titulo ?? 'Centro de Apoio Social e Ambiental' }}">
            </div>
        </header>
        @include('layout._includes.navbar')
