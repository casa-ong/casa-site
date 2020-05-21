<nav class="nav-links">
    <a id="nav-inicio" class="nav-link" href="{{ route('site.home') }}">Início</a>
    <input tabindex="0" type="checkbox" id="nav-toggle" class="nav-toggle">
    <div class="nav-fluid">
        <a class="nav-link" href="{{ route('site.noticias').'#noticias' }}">Notícias</a>
        <a class="nav-link" href="{{ route('site.eventos').'#eventos' }}">Eventos</a>
        <a class="nav-link" href="{{ route('site.projetos').'#projetos' }}">Projetos</a>
        <a class="nav-link" href="{{ route('site.voluntarios') }}">Voluntarios</a>
        <a class="nav-link" href="{{ route('sugestao.adicionar') }}">Sugestões</a>
        <a class="nav-link" href="{{ route('site.home').'#sobre' }}">Sobre</a>
        @if(Auth::guest())
        <a class="nav-link" href="{{ route('login') }}">Acesso</a>
        @else
                @php($user = Auth::user())
                <label for="dropdownAdminBtn" class="nav-link">
                    {{ $user->name }} <i class="fas fa-caret-down"></i>
                    <input type="checkbox" class="dropdownAdminBtn" id="dropdownAdminBtn">
                    <div id="dropdownAdminLinks" class="dropdownAdminLinks">
                        <a href="{{ route('admin.index') }}">Painel de Controle
                            <i class="fas fa-user-cog"></i>
                        </a>
                        <a href="{{ route('login.sair') }}">Sair
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </div>
                </label>
        @endif
    </div>
    <label for="nav-toggle" class="nav-toggle-label">
        <span class="fas fa-bars"></span>
        <span class="fas fa-times"></span>
    </label>
</nav>