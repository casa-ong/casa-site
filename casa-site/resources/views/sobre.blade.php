@extends('layout.site')
@section('titulo', 'Sobre nós')

@section('conteudo')
        <h2>{{ isset($registro->titulo_sobre) ? $registro->titulo_sobre : '' }}</h2>
        <div class="sobre-layout">
            <div class="sobre-img">
                <img src="{{ isset($registro->anexo_sobre) ? asset($registro->anexo_sobre) : '' }}" alt="">
            </div>
            <div class="sobre-text">
                <p>{{ isset($registro->texto_sobre) ? $registro->texto_sobre : '' }}</p>
            </div>
            <div class="sobre-contact">
                <ul>
                    <h3>Contato</h3>
                    @if(isset($registro->telefone))
                        <li>Telefone: {{ $registro->telefone }}</li>
                    @endif
                    @if(isset($registro->email))
                        <li>Email: {{ $registro->email }}</li>
                    @endif
                    @if(isset($registro->instagram))
                        <li>Instagram: {{ $registro->instagram }}</li>
                    @endif
                    @if(isset($registro->twitter))
                        <li>Twitter: {{ $registro->twitter }}</li>
                    @endif
                    @if(isset($registro->facebook))
                        <li>Facebook: {{ $registro->facebook }}</li>
                    @endif
                </ul>
            </div>
        </div>
@endsection