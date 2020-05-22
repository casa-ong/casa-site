@extends('layout.site')
@section('titulo', 'Inicio - CASA')

@section('banner')
        <div class="banner" style="background-image: url({{ isset($sobre->banner) ? asset($sobre->banner) : '' }});"></div>
@endsection

@section('conteudo')
        <div class="item">
            <form id="form-btn-vol" action="{{ route('site.home.voluntario.adicionar') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="input-field">
                    <label for="email">Quer ser um voluntário?</label>
                    <input class="{{ $errors->has('email') ? 'error' : '' }}" name="email" type="text" placeholder="Digite seu email para se cadastrar" value="{{ old('email') }}">
                    @error('email')
                        <p class="error" form="form-btn-vol">{{ $message }}</p>
                    @enderror
                    <button class="btn">Enviar</button>
                </div>
            </form>
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
    <a id="sobre"></a>
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