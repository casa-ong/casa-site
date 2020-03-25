@extends('layout.site')
@section('titulo', 'Lista de Projetos')

@section('conteudo')
    <div class="form-title">
        <h3>Login</h3>
    </div>
    <div class="form">
        <form action="{{ route('site.login.entrar') }}" method="POST">
            {{ csrf_field() }}

            <div class="input-field">
                <input type="text" name="email"> 
                <label for="email">Email</label>
            </div>
            <div class="input-field">
                <input type="password" name="senha">
                <label for="senha">Senha</label>
            </div>
            <button class="btn">Entrar</button>
        </form>

    </div>
@endsection