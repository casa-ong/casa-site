@extends('layout.site')
@section('titulo', 'Redefinir senha | Casa')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1>{{ __('Reset Password') }}</h1>
            @if (session('status'))
                <div class="alert alert-success" role="alert" onclick="$(this).toggle('hide')">
                    <p>{{ session('status') }}</p>
                </div>
            @endif
        </div>
        <div class="item-form">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="input-field">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="@error('email') error @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="input-btn">
                    <button type="submit" class="btn btn-green">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
