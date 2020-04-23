@extends('layout.site')
@section('titulo', 'Projetos - CASA')

@section('conteudo')
<div id="titulo" class="item-title">
    <h1>Nossos voluntários do {{ isset($estado) ? $estado : '' }}</h1>
</div>
<p class="breadcrumbs"><a href="{{ route('site.home') }}">Início</a> / <a href="{{ route('site.voluntarios') }}">Voluntários</a> / {{ $estado }}</p>
<div class="row">
    @if(isset($registros) && count($registros) > 0)
        @foreach ($registros as $registro)
            @include('site.voluntarios._card')
        @endforeach
    @else
        <p>Nenhum voluntário aqui por enquanto, <strong>seja o primeiro!</strong></p>
    @endif
</div>
@endsection

@section('scripts')
    <style>
        div.user-card {
            display: flex;
            flex-direction: row
        }

        div.user-card div.card-data
    </style>
@endsection