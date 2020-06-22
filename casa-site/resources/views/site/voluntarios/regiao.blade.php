@extends('layout.site')
@section('titulo', 'Projetos - CASA')

@section('conteudo')
<div id="titulo" class="item-title">
    <h1>Nossos voluntários</h1>
</div>
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