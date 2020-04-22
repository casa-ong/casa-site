@extends('layout.site')
@section('titulo', 'Projetos - CASA')

@section('conteudo')
<div id="titulo" class="item-title">
    <h1>Nossos voluntários do {{ isset($estado) ? $estado : '' }}</h1>
</div>
    @foreach ($registros as $registro)
    <div class="user-card">
        <div class="card-img">
            <img src="{{ asset($registro->foto) }}" alt="">
        </div>
        <div class="card-data">
            <h4>{{ $registro->name }}</h4>
            <h4>aniversario</h4>
            <h4>profissao</h4>
            <h4>projeto</h4>
            <h4>cidade</h4>
            <h4>estado</h4>
        </div>
    </div>
    @endforeach

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