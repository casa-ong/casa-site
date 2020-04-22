@extends('layout.site')
@section('titulo', 'Inicio - CASA')

@section('banner')
        <div class="banner" style="background-image: url({{ isset($sobre->banner) ? asset($sobre->banner) : '' }});"></div>
@endsection

@section('conteudo')
        <div class="item">
            <div class="input-field">
                <label for="email">Quer ser um voluntário?</label>
                <input name="email" type="text" placeholder="Digite seu email para se cadastrar">
                <a href="{{ route('site.voluntario.adicionar') }}" class="btn">Enviar</a>
            </div>
        </div>

    @if(isset($noticias) && count($noticias) > 0)
        <div id="noticias" class="item-title">
            <h1>Últimas Notícias</h1>
        </div>
        <div class="item">
            @foreach ($noticias as $noticia)
                @include('site.noticias._card')
            @endforeach
        </div>
    @endif

    @if(isset($sobre))
        @include('sobre')
    @endif

    @if(isset($projetos) && count($projetos) > 0)
        <div id="projetos" class="item-title">
            <h1>Nossos projetos</h1>
        </div>
        <div class="item">
            @foreach ($projetos as $projeto)
                @include('site.projetos._card')
            @endforeach
        </div>
    @endif
@endsection