<nav class="nav-links">
    <a class="nav-link" href="{{ route('site.home') }}">Início</a>
    <a class="nav-link" href="{{ route('site.noticias').'#noticias' }}">Notícias</a>
    <a class="nav-link" href="{{ route('site.eventos') }}">Eventos</a>
    <a class="nav-link" href="{{ route('site.home').'#projetos' }}">Projetos</a>
    <a class="nav-link" href="{{ route('site.voluntarios') }}">Voluntarios</a>
    <a class="nav-link" href="{{ route('sugestao.adicionar') }}">Sugestões</a>
    <a class="nav-link" href="{{ route('site.home').'#sobre' }}">Sobre</a>
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
</nav>