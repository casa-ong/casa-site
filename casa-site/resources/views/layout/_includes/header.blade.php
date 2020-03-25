<!DOCTYPE html>
<html>
<head>
    <title>@yield('titulo')</title>
    <!-- Estilo da pagina -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <!-- CSS for BootstrapCDN -->
    <!--link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"-->
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <!--a class="navbar-brand" href="#">Centro de Apoio Social e Ambiental</a-->
            </div>
            <div class="nav-links">
                <a class="nav-link" href="#">Início</a>
                <a class="nav-link" href="#">Notícias</a>
                <a href="#" class="nav-link" href="#">Eventos</a>
                <a class="nav-link" href="{{ route('admin.projetos') }}">Projetos</a>
            </div>
        </nav>
    </header>
    <div class="container">
