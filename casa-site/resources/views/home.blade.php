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

        <div id="noticias" class="item-title">
            <h1>Últimas Notícias</h1>
        </div>
        <div class="item">
            @foreach ($noticias as $noticia)
                @if($noticia->publicado)
                    <div class="news-card">
                        <div class="news-card-img">
                            <a href="{{ route('site.noticia', $noticia->id) }}"><img src="{{ $noticia->anexo }}" alt=""></a>
                        </div>
                        <div class="news-card-text">                            
                            <p>{{ date('d/m/Y', strtotime($noticia->created_at)) }} por <a href="#">{{ $noticia->autor }}</a></p>
                            <h4><a href="{{ route('site.noticia', $noticia->id) }}">{{ $noticia->titulo }}</a></h4>
                            <p class="news-card-p">{{ $noticia->texto }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
            <!--a title="Ver todas as notícias" href="{{ route('site.noticias').'#noticias' }}" class="btn">
                <i class="fas fa-chevron-right"></i>
            </a-->
        </div>
        @include('sobre')
        @include('projetos')
@endsection