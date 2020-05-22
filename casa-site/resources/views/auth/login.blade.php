@extends('layout.site')
@section('titulo', 'Login - Casa')

@section('conteudo')
<div class="content">
    <div class="item-title">
        <h1>{{ __('Login') }}</h1>
    </div>
    <div class="item-form">
        <form action="{{ route('login.entrar') }}" method="POST">
            {{ csrf_field() }}

            <div class="input-field">
                <label for="email">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="@error('email') error @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-field">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="@error('password') error @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div style="display:flex; justify-content: space-between">
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
                <button type="submit" class="btn">{{ __('Login') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
