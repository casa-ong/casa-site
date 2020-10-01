@extends('layout.site')
@section('titulo', 'Redefinir senha | Casa')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1>{{ __('Reset Password') }}</h1>
        </div>
        <div class="item-form">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="input-field">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                    <input readonly id="email" type="email" class="@error('email') error @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-field">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" class="@error('password') error @enderror" name="password" required autocomplete="new-password">
                    <p class="input-info">
                        <span class="fas fa-exclamation-circle"></span>
                        A senha deve conter letras e números e não deve conter caracteres especiais.
                    </p>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-field">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" class="@error('password') error @enderror" type="password" name="password_confirmation" required autocomplete="new-password">
                </div>
                <div class="input-btn">
                    <button type="submit" class="btn btn-green">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
