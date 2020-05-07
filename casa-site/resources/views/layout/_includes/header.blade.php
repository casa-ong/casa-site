<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>
    
    <!-- Estilo da pagina -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <!-- JavaScript da pagina -->
    <script src="{{ asset('js/dropdown_on_click.js') }}" crossorigin="anonymous"></script>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ isset($sobre->logo) ? asset($sobre->logo) : asset('img/logos/casa-marca.png') }}">
    
    <!-- Icones do Font Awesome -->
    <script src="https://kit.fontawesome.com/8eafe50798.js" defer crossorigin="anonymous"></script>

    <!-- Font monterrat regular -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet"> 
    
    <!-- include summernote css/js -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.js"></script>

    <!-- Mascaras -->
    <script type="text/javascript" src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/jquery/jquery.inputmask.js') }}"></script>      
    <script type="text/javascript" src="{{ asset('js/jquery/jquery.maskMoney.min.js') }}"></script>
    <script defer="true" src="{{ asset('js/masks.js') }}"></script>
</head>

<body>
    <header>
        @php($sobre = App\Sobre::latest('updated_at')->first())
        @if($sobre != null)
        @php($titulo = $sobre->titulo_site)
        @php($slogan = $sobre->slogan)
        @php($logo = $sobre->logo)
        @php($banner = $sobre->banner)
        @endif

        <div class="header">
            <img class="banner" src="{{ isset($banner) ? asset($banner) : asset('img/banner/casa-banner.png') }}" alt="{{ $titulo ?? 'Centro de Apoio Social e Ambiental' }}">
        </div>
    </header>
    @include('layout._includes.navbar')
