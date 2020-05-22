@extends('layout.site')
@section('titulo', 'Redefinir senha - Casa')

@section('conteudo')
<div class="content">
    <div class="item-title">
        <h1>{{ __('Reset Password') }}</h1>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <p>{{ session('success') }}</p>
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
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-btn">
                <button type="submit" class="btn btn-primary">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
