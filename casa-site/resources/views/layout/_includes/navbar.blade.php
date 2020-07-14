<nav class="nav-links">
    <div style="display: flex">
        @if((!Request::is('/')
            && Request::is('admin/*')
            && !Request::is('admin/index'))
            || Request::is('voluntario/*'))
            <a title="Voltar" href="#" class="nav-link" type="button" onclick="history.back()">
                <span class="fas fa-chevron-left"></span>
            </a>
        @endif
        <a id="nav-inicio" title="Início" class="nav-link" href="{{ route('site.home') }}">Início</a>
    </div>
    <input tabindex="0" type="checkbox" id="nav-toggle" class="nav-toggle">
    <div class="nav-fluid">
        <a class="nav-link" href="{{ route('site.noticias').'#noticias' }}">Notícias</a>
        <a class="nav-link" href="{{ route('site.eventos').'#eventos' }}">Eventos</a>
        <a class="nav-link" href="{{ route('site.projetos').'#projetos' }}">Projetos</a>
        <a class="nav-link" href="{{ route('site.voluntarios').'#voluntarios' }}">Voluntários</a>
        <a class="nav-link" href="{{ route('site.home').'#sobre' }}">Quem somos</a>
        <a class="nav-link rounded" href="{{ route('site.home').'#contribua' }}">Contribua</a>
        @if(Auth::user())
        @php($user = Auth::user())
            <nav class="nav-logged">
                
                        @if($user->admin)
                            <a class="nav-link" title="Painel de Controle" href="{{ route('admin.index').'#controle' }}">
                                <i class="fas fa-sliders-h"></i>
                            </a>
                        @endif
                        
                        <a class="nav-link" title="Minha conta" href="{{ route('admin.voluntario.editar', $user->id) }}">
                            <i class="fas fa-user"></i>
                        </a>
                        <a class="nav-link" title="Sair" href="{{ route('login.sair') }}">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
            </nav>
        @endif
    </div>
    <label title="Menu de navegação" for="nav-toggle" class="nav-toggle-label">
        <span class="fas fa-bars"></span>
        <span class="fas fa-times"></span>
    </label>
</nav>