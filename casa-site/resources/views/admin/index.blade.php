@extends('layout.site')
@section('titulo', 'Painel de controle | Casa')
@section('anchor', 'controle')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1 class=""><strong>Bem-vindo</strong> ao seu painel de controle, {{ Auth::user()['name'] }}!</h1>
        </div>
        <div class="item" style="border-bottom: 0;">
            <a class="admin-card" href="{{ route('admin.noticias') }}">
                <span class="fas fa-newspaper"></span>
                <h2>Notícias</h2>
            </a>
            <a class="admin-card" href="{{ route('admin.eventos') }}">
                <span class="fas fa-calendar-alt"></span>
                <h2>Eventos</h2>
            </a>
            <a class="admin-card" href="{{ route('admin.projetos') }}">
                <span class="fas fa-scroll"></span>
                <h2>Projetos</h2>
            </a>
            <a class="admin-card" href="{{ route('admin.voluntarios') }}">
                <span class="fas fa-users"></span>
                <h2>Voluntários</h2>
            </a>
            <a class="admin-card" href="{{ route('admin.sugestoes') }}">
                <span class="fas fa-comments"></span>
                <h2>Sugestões</h2>
            </a>
            <a class="admin-card" href="{{ route('admin.enquetes') }}">
                <span class="fas fa-poll"></span>
                <h2>Enquetes
                    <span class="fa fa-new"></span>
                </h2>
            </a>
            <a class="admin-card" href="{{ route('admin.doacoes') }}">
                <span class="fas fa-hand-holding-medical"></span>
                <h2>Doações</h2>
            </a>
            <a class="admin-card" href="{{route('admin.despesas')}}">
                <span class="fas fa-money-bill-alt"></span>
                <h2>Despesas</h2>
            </a>
            <a class="admin-card" href="{{ route('admin.newsletters') }}">
                <span class="fas fa-envelope-open-text"></span>
                <h2>NewsLetters</h2>
            </a>
            <a class="admin-card" href="{{ route('admin.configuracoes') }}">
                <span class="fas fa-cog"></span>
                <h2>Configurações</h2>
            </a>
        </div>
    </div>
</div>
@endsection
