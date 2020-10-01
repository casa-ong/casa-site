@extends('layout.site')
@section('titulo', 'Entrar | Casa')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1>{{ __('Login') }}</h1>
            @if(Session::has('success'))
                <div class="alert alert-success" onclick="$(this).toggle('hide')">
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif
        </div>
        <div class="item-form">
            <form action="{{ route('login.entrar') }}" method="POST">
                {{ csrf_field() }}

                <div class="input-field">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="@error('email') error @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="input-field">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" class="@error('password') error @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div style="display:flex; justify-content: space-between; padding-top: 10px;">
                    <div>
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
                <div class="input-btn">
                    <button type="submit" class="btn btn-green">{{ __('Login') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection