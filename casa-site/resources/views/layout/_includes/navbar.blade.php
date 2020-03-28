@php($dadosSite = App\Sobre::latest('updated_at')->first())
@if($dadosSite != null)
@php($titulo = $dadosSite->titulo_site)
@php($slogan = $dadosSite->slogan)
@php($logo = $dadosSite->logo)
@php($banner = $dadosSite->banner)
@endif

<nav class="navbar" style="background-image: linear-gradient( rgba(162,194,90,0.5), rgba(162,194,90,0.5) ), url({{ isset($banner) ? asset($dadosSite->banner) : '' }}); background-position: center; background-size: 100%;">
    <div class="nav-dados">
        <div class="img-logo">
            <img src="{{ isset($logo) ? asset($logo) : '' }}" alt="">
        </div>
        <div class="logo">
            <h1>{{ isset($titulo) ? $titulo : '' }}</h1>
            <h2>{{ isset($slogan) ? $slogan : '' }}</h2>
        </div>
    </div>
    <div class="nav-links">
        <a class="nav-link" href="{{ route('site.home') }}">Início</a>
        <a class="nav-link" href="#">Notícias</a>
        <a class="nav-link" href="{{ route('site.eventos') }}">Eventos</a>
        <a class="nav-link" href="{{ route('site.projetos') }}">Projetos</a>
        <a class="nav-link" href="{{ route('site.voluntarios') }}">Voluntarios</a>
        <a class="nav-link" href="{{ route('sugestao.adicionar') }}">Sugestões</a>
        <a class="nav-link" href="{{ route('site.sobre') }}">Sobre</a>
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