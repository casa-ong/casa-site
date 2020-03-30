@extends('layout.site')
@section('titulo', 'Inicio - CASA')

@section('banner')
        <div class="banner" style="background-image: url({{ asset($sobre->banner) }});">
            <!--img src="{{ asset($sobre->banner) }}" alt=""-->
        </div>
@endsection

@section('conteudo')
        <div class="item">
            <div class="input-field">
                <label for="email">Quer ser um voluntário?</label>
                <input name="email" type="text" placeholder="Digite seu email para se cadastrar">
                <a href="{{ route('site.voluntario.adicionar') }}" class="btn" style="margin-left:0.5em;">Enviar</a>
            </div>
        </div>
        @include('projetos')
        @include('sobre')
        @include('noticias')
@endsection