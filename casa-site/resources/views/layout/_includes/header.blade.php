<!DOCTYPE html>
<html>
<head>
    <title>@yield('titulo')</title>
    <!-- Estilo da pagina -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <!-- JavaScript da pagina -->
    <script src="{{ asset('js/dropdownOnClick.js') }}" crossorigin="anonymous"></script>
    <!-- Icones do Font Awesome -->
    <!--script src="https://kit.fontawesome.com/8eafe50798.js" crossorigin="anonymous"></script-->
    <!-- CSS for BootstrapCDN -->
    <!--link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"-->
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <h1>Centro de Apoio Social e Ambiental</h1>
                <h2>Para todo rio, há uma nascente</h2>
            </div>
            <div class="nav-links">
                <a class="nav-link" href="{{ route('site.home') }}">Início</a>
                <a class="nav-link" href="#">Notícias</a>
                <a class="nav-link" href="#">Eventos</a>
                <a class="nav-link" href="#">Projetos</a>
                @if(Auth::guest())
                    <a class="nav-link" href="{{ route('login') }}">Acesso</a>
                @else
                    @php($user = Auth::user())
                    <div class="dropdown">
                        <button onclick="dropdownClick()" class="dropbtn nav-link" href="{{ route('login') }}">{{ $user['name'] }}(Admin)
                            <i class="fas fa-caret-down"></i>
                        </button>
                        <div id="dropdownLinks" class="dropdown-content">
                            <a href="{{ route('admin.index') }}">Painel de Controle
                                <i class="fas fa-user-cog"></i>
                            </a>
                            <a href="{{ route('login.sair') }}">Sair
                                <i class="fas fa-sign-out-alt"></i>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </nav>
    </header>
    <div class="container">
