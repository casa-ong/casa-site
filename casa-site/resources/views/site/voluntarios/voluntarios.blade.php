@extends('layout.site')
@section('titulo', 'Nossos voluntários | Casa')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div id="voluntarios" class="anchor item-title">
            <h1>Voluntários</h1>

            @if(Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif

        </div>
        <div class="title row text-center">
            <p>
                Uma equipe de <strong>{{ $n_voluntarios }} voluntários</strong> espalhados por <strong>todo Brasil!</strong>
                <br>Conheça nossos voluntários <strong>por região</strong> abaixo
            </p>
        </div>
        <div class="mapa">
            <ul id="map">
                <li id="cno" estado="no"><a href="{{ route('site.voluntarios.norte').'#titulo' }}" id="no" title="Norte"><img src="{{ asset('img/user_map/null.gif') }}" alt="Norte" /></a></li>
                <li id="cne" estado="ne"><a href="{{ route('site.voluntarios.nordeste').'#titulo' }}" id="ne" title="Nordeste"><img src="{{ asset('img/user_map/null.gif') }}" alt="Nordeste" /></a></li>
                <li id="cco" estado="co"><a href="{{ route('site.voluntarios.centro').'#titulo' }}" id="co" title="Centro-Oeste"><img src="{{ asset('img/user_map/null.gif') }}" alt="Centro-Oeste" /></a></li>
                <li id="cse" estado="se"><a href="{{ route('site.voluntarios.sudeste').'#titulo' }}" id="se" title="Sudeste"><img src="{{ asset('img/user_map/null.gif') }}" alt="Sudeste" /></a></li>
                <li id="csu" estado="su"><a href="{{ route('site.voluntarios.sul').'#titulo' }}"id="su" title="Sul"><img src="{{ asset('img/user_map/null.gif') }}" alt="Sul" /></a></li>
            </ul>
        </div>
        <div class="mapa-mobile">
            <a href="{{ route('site.voluntarios.norte').'#titulo' }}" title="Norte">Norte</a>
            <a href="{{ route('site.voluntarios.nordeste').'#titulo' }}" title="Nordeste">Nordeste</a>
            <a href="{{ route('site.voluntarios.centro').'#titulo' }}" title="Centro-Oeste">Centro-oeste</a>
            <a href="{{ route('site.voluntarios.sudeste').'#titulo' }}" title="Sudeste">Sudeste</a>
            <a href="{{ route('site.voluntarios.sul').'#titulo' }}"title="Sul">Sul</a>
        </div>
    </div>
    <section class="sidebar">
        <h1 class="mb">Seja <strong>voluntário</strong></h1>
        <div class="card form-card">
            <form id="form-btn-vol" action="{{ route('site.home.voluntario.adicionar') }}" method="POST" enctype="multipart/form-data">

                {{ csrf_field() }}
                <div class="input-field">
                    <label for="email">Digite seu e-mail para começar</label>
                    <input class="{{ $errors->has('email') ? 'error' : '' }}" name="email" type="text" placeholder="Digite seu email para se cadastrar" value="{{ old('email') }}">
                    @error('email')
                        <p class="error" form="form-btn-vol">{{ $message }}</p>
                    @enderror
                    <button class="btn btn-green">Cadastrar-se</button>
                </div>
            </form>
        </div>
        @include('site._includes._ultimas_noticias_sidebar')
    </section>
</div>
@endsection
@section('scripts')
    <style type="text/css">

        .active { display:block; }
        ul#map {display: flex; margin: 0; padding: 0; list-style: none; width: 505px; height: 450px; background-size: 505px 450px; background-image: url({{ asset('img/user_map/map.png') }}) }});}
        ul#map li {display: block; padding: 0; position: absolute;}
        li#cno {margin-top: 0px; margin-left: 0px; z-index: 99}
        li#cne {margin-top: 75px; margin-left: 290px; }
        li#cco {margin-top: 150px; margin-left: -140px; z-index: 98}
        li#cse {margin-top: 225px; margin-left: 90px; }
        li#csu {margin-top: 318px; margin-left: -40px; }

        ul#map li a {display: block; text-decoration: none; position: absolute;}
        a#no {width: 320px; height: 180px; }
        a#ne {width: 150px; height: 160px; }
        a#co {width: 150px; height: 150px; }
        a#se {width: 145px; height: 100px; }
        a#su {width: 90px; height: 115px; }

        /* Código pronto via http://css.spritegen.com (com alterações nos seletores) */

        a#ne:hover, a#ne:active, a#no:hover, a#no:active, a#co:hover, a#co:active, a#se:hover, a#se:active, a#su:hover, a#su:active
        { display: block; background: url({{ asset('img/user_map/sprite.gif') }}) no-repeat; background-size: 324px 869px; cursor: pointer; }

        a#no:hover, a#no:active { background-position: 9px 0px; width: 320px; height: 215px; }
        a#ne:hover, a#ne:active { background-position: -3px -219px; width: 150px; height: 195px; }
        a#co:hover, a#co:active { background-position: -4px -421px; width: 166px; height: 185px; }
        a#se:hover, a#se:active { background-position: -2px -614px; width: 145px; height: 125px; }
        a#su:hover, a#su:active { background-position: -12px -741px; width: 102px; height: 139px; }

        /* Fim sprite */

        ul#map li a img {border: 0; width: inherit; height: inherit;}


        .mapa {
            display: flex; 
            justify-content: center;
        }

        .mapa-mobile {
            display: none;
        }

        /* Mobile */
        @media only screen and (max-width: 520px) {
            .mapa {
                display: none;
            }

            .mapa-mobile {
                display: flex;
                flex-direction: column;
            }

            .mapa-mobile a {
                text-decoration: none;
                color: #fff;
                background-color: #000;
                border-radius: 5px; 
                font-weight: bold;
                text-transform: uppercase;
                padding: 1em;
                text-align: center;
                margin-bottom: 0.5em;
                transition: background-color 250ms ease-in-out;

            }

            .mapa-mobile a:hover {
                color: #000;
                background-color: rgb(150, 187, 145);
                transition: background-color 250ms ease-in-out;
            }
        }    
        /* Fim de mobile */
    </style>
@endsection