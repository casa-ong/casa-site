@extends('layout.site')
@section('titulo', 'Início | Casa')

@section('banner')
        <div class="banner" style="background-image: url({{ isset($sobre->banner) ? asset($sobre->banner) : '' }});"></div>
@endsection

@section('conteudo')
    @if(isset($noticias) && count($noticias) > 0)
        <div class="gallery js-flickity carousel"
            data-flickity-options='{ "wrapAround": true, "autoPlay": true }'>
            @foreach ($noticias as $index => $item)
                @include('site._includes._carousel_item')
            @endforeach
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-error text-center">
            <p>{{ Session::get('error') }}</p>
        </div>
    @endif
    
    <div id="sobre" class="anchor item-title">
        <h1>Quem somos</h1>
    </div>
    <div class="item border-0">
        <div class="card card-big">
            <div class="card-img">
                <img src="{{ asset('img/icons/volunteers.png') }}" alt="Desenho de voluntários">
            </div>
            <div class="card-text">                            
                <h4>Uma equipe de <br><strong>{{ $n_voluntarios }} voluntários</strong></h4>
                <p>Temos voluntários espalhados por <strong>todo Brasil!</strong></p>
            </div>
            <div class="action text-center">
                <a href="{{ route('site.voluntarios') }}" class="btn btn-green">Conheça</a>
            </div>
        </div>
        <div class="card card-big">
            <div class="card-img">
                <img src="{{ asset('img/icons/project.png') }}" alt="Desenho de voluntários">
            </div>
            <div class="card-text">                            
                <h4>Envolvidos em <br><strong>{{ $n_projetos }} projetos</strong></h4>
                <p>Projetos para melhoria do <strong>meio ambiente</strong> e da <strong>sociedade</strong>.</p>
            </div>
            <div class="action text-center">
                <a href="{{ route('site.projetos') }}" class="btn btn-green">Conheça</a>
            </div>
        </div>
    </div>

    @if(isset($sobre))
        <div class="item-title">
            <h1>Nossa <strong>missão</strong></h1>
        </div>
        <div class="item sobre text-center">
            {{ $sobre->texto_sobre ?? '' }}
        </div>
    @endif

    @if(isset($projetos) && count($projetos) > 0)
        <div id="projetos" class="item-title mt-1">
            <h1>Nossos <strong>projetos</strong></h1>
        </div>
        <div class="item">
            @foreach ($projetos as $projeto)
                @include('site.projetos._card')
            @endforeach
        </div>
    @endif

    <div id="contribua" class="anchor item-title mt-1">
        <h1>Como <strong>contribuir</strong></h1>
    </div>
    <div class="item">
        <div class="card card-small">
            <div class="card-img">
                <img src="{{ asset('img/icons/volunteer.png') }}" alt="Desenho de mãos com um coração">
            </div>
            <div class="card-text">                            
                <h4>Sendo <br><strong>voluntário</strong></h4>
            </div>
            <div class="action text-center">
                <a href="{{ route('site.voluntario.adicionar') }}" class="btn btn-green">Saiba como</a>
            </div>
        </div>
        <div class="card card-small">
            <div class="card-img">
                <img src="{{ asset('img/icons/suggest.png') }}" alt="Desenho de mulher opinando">
            </div>
            <div class="card-text">                            
                <h4>Fazendo <br><strong>sugestões</strong></h4>
            </div>
            <div class="action text-center">
                <a href="{{ route('sugestao.adicionar') }}" class="btn btn-green">Saiba como</a>
            </div>
        </div>
        <div class="card card-small">
            <div class="card-img">
                <img src="{{ asset('img/icons/donate.png') }}" alt="Desenho de mão segurando moeda">
            </div>
            <div class="card-text">                            
                <h4>Fazendo uma <br><strong>doação</strong></h4>
            </div>
            <div class="action text-center">
                <a onclick="window.alert('Aff, essa função ainda está em construção, entre em contato para doar pfv!')" class="btn btn-green">Saiba como</a>
            </div>
        </div>        
    </div>

@endsection