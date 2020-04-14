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
                <a href="{{ route('site.voluntario.adicionar') }}" class="btn" style="margin-left:0.5em;">Enviar</a>
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
                <!--a title="Ver todas as notícias" href="{{ route('site.noticias').'#noticias' }}" class="btn">
                    <i class="fas fa-chevron-right"></i>
                </a-->
            </div>
        @endif
        @include('sobre')
        @if(isset($projetos) && count($projetos) > 0)
            <div id="projetos" class="item-title">
                <h1>Nossos projetos</h1>
            </div>
            <div class="item">
                <div style="display: flex; flex-direction: row">
                    <div class="card-big" style="background-image: linear-gradient( rgba(0,0,0,0.9), rgba(0,0,0,0.6) ), url({{ isset($projetos[0]->anexo) ? asset($projetos[0]->anexo) : '' }});">
                        <h1>{{ $projetos[0]->nome }}</h1>
                        <p>{{ $projetos[0]->user->name }}</p>
                        <p class="card-description">{{ $projetos[0]->descricao }}</p>
                    </div>
                    <div>
                        @for ($i = 1; $i < (count($projetos) > 3 ? 3 : count($projetos)); $i++)
                            @if($projetos[$i]->publicado)
                                <div class="card" style="background-image: linear-gradient( rgba(0,0,0,0.9), rgba(0,0,0,0.6) ), url({{ isset($projetos[$i]->anexo) ? asset($projetos[$i]->anexo) : '' }});">
                                    <h1>{{ $projetos[$i]->nome }}</h1>
                                    <p>{{ $projetos[$i]->user->name }}</p>
                                    <p class="card-description">{{ $projetos[$i]->descricao }}</p>
                                </div>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
        @endif
@endsection