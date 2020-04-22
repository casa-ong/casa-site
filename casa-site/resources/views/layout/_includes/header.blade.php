<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>
    
    <!-- Estilo da pagina -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <!-- JavaScript da pagina -->
    <script src="{{ asset('js/dropdown_on_click.js') }}" crossorigin="anonymous"></script>
    
    <!-- Icones do Font Awesome -->
    <script src="https://kit.fontawesome.com/8eafe50798.js" defer crossorigin="anonymous"></script>
    
    <!-- include summernote css/js -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.js"></script>
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
            <h1>{{ isset($titulo) ? $titulo : '' }}</h1>
            <h2>{{ isset($slogan) ? $slogan : '' }}</h2>
        </div>
    </header>
    @include('layout._includes.navbar')
