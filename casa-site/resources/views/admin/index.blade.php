@extends('layout.site')
@section('titulo', 'Lista de Projetos')
@php($user = Auth::user())

@section('conteudo')
    <h1 class="">Bem-vindo ao seu painel de controle, {{ $user['name'] }}!</h1>

        <div class="admin-container">
            <a class="admin-card">
                <h2>Feed do site</h2>
            </a>
            <a class="admin-card">
                <h2>Eventos</h2>
            </a>
            <a class="admin-card" href="{{ route('admin.projetos') }}">
                <h2>Projetos</h2>
            </a>
            <a class="admin-card">
                <h2>Voluntários</h2>
            </a>
            <a class="admin-card">
                <h2>Sobre</h2>
            </a>
        </div>
@endsection