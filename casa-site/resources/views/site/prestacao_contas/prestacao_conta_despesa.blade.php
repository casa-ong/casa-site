@extends('layout.site')
@section('titulo', 'Prestação de Conta | Casa')


@php
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
@endphp

@php
$user = App\Models\User::find($registro->user_id);
@endphp
{{$user != null ? $user->name : ''}}
@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1>Prestação de Conta</h1>
        </div>
        <div>
            <div class="action text-center">
                <a type="text" name="descricao" placeholder="Descrição">Foi gasto <strong>{{$registro->valor}} </strong> reais em {{strtolower($registro->nome ?? ' ')}}
                    declarado por {{ $user->name}} no dia {{ strftime('%d de %B  de %Y', strtotime($registro->created_at)) }}, na descrição do gasto escreveu "{{$registro->descricao}}"".</a>
            </div>
        </div>
        <div class="input-field">
            <label for="nota_fiscal" class="input">Nota fiscal
                <div class="banner-preview">
                    <span class="fas fa-image"></span>
                    <img id="nota-fiscal" src="{{ isset($registro->nota_fiscal) ? asset($registro->nota_fiscal) : '' }}" alt="">                   
                </div>
            </label>
            @error('nota_fiscal')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>
</div>
@endsection