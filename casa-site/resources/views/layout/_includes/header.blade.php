<!DOCTYPE html>
<html>
<head>
    <title>@yield('titulo')</title>
    <!-- Estilo da pagina -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <!-- JavaScript da pagina -->
    <script src="{{ asset('js/dropdown_on_click.js') }}" crossorigin="anonymous"></script>
    <!-- Icones do Font Awesome -->
    <script src="https://kit.fontawesome.com/8eafe50798.js" crossorigin="anonymous"></script>
    <!-- CSS for BootstrapCDN -->
    <!--link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"-->
</head>

<body>
    <header>
        @include('layout._includes.navbar')
    </header>
    <div class="container">
