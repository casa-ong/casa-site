@extends('layout.site')
@section('titulo', 'Link expirado')


@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <i style="font-size: 3rem" class="fas fa-exclamation-triangle"></i>
            <h1>Erro 403</h1>
        </div>
        @if(Session::has('success'))
        <div class="alert alert-success" onclick="$(this).toggle('hide')">
            <p>{{ Session::get('success') }}</p>
        </div>
        @endif
        <div class="item-form">
            <form id="form-btn-vol" action="{{ route('verification.resend') }}" method="POST" enctype="multipart/form-data">
    
                {{ csrf_field() }}
                <div class="input-field">
                    <p style="font-weight: 500;">Link de verificação de e-mail expirado. <strong>Solicite um novo link abaixo:</strong></p>
                    <input class="{{ $errors->has('email') || $errors->has('emailNotVerified') ? 'error' : '' }}" name="email" type="text" placeholder="Digite seu email para se cadastrar" value="{{ old('email') }}">
                    @error('email')
                        <p class="error" form="form-btn-vol">{{ $message }}</p>
                    @enderror
                    @error('emailNotVerified')
                        <p>{!! $message !!}</p>
                    @enderror
                </div>
                <div class="input-btn">
                    <button form="form-btn-vol" type="submit" class="btn btn-green">Receber novo link</button>
                </div>
            </form>
        </div>
        <p>Não é veio de um link de verificação de e-mail? Contate-nos em <a href="mailto:suporte@casaong.org">suporte@casaong.org</a></p>
    </div>
</div>

@endsection