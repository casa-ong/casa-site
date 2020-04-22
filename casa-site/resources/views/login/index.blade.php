@extends('layout.site')
@section('titulo', 'Lista de Projetos')

@section('conteudo')
<div class="content">
    <div class="item-title">
        <h1>Login</h1>
    </div>
    <div class="item-form">
        <form action="{{ route('login.entrar') }}" method="POST">
            {{ csrf_field() }}

            <div class="input-field">
                <label for="email">Email</label>
                <input type="text" name="email"> 
            </div>
            <div class="input-field">
                <label for="senha">Senha</label>
                <input type="password" name="senha">
            </div>
            <div class="input-btn">
                <button class="btn">Entrar</button>
            </div>
        </form>
    </div>
</div>
@endsection
