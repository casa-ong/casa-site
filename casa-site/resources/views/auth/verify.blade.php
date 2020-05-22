@extends('layout.site')
@section('titulo', 'Verifique seu email - CASA')

@section('conteudo')
<div class="content">
    <div class="item-title">
        <h1>{{ __('Verify Your Email Address') }}</h1>

        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                <p>{{ __('A fresh verification link has been sent to your email address.') }}</p>
            </div>
        @endif
        
        <p>{{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }},</p>

    </div>
    <div class="item-form">

        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <div class="input-btn">
                <button type="submit" class="btn">{{ __('click here to request another') }}</button>.
            </div>
        </form>
    </div>
</div>
@endsection
