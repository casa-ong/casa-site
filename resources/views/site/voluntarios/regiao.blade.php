@extends('layout.site')
@section('titulo', 'Voluntários do '.$estado.' | CASA')

@section('conteudo')
<div id="titulo" class="item-title">
    <h1>Nossos <strong>voluntários do {{ $estado ?? 'Brasil' }}</strong></h1>
</div>
<div class="row" style="max-width: 960px; margin: 0 auto;">
    @if(isset($registros) && count($registros) > 0)
        @foreach ($registros as $registro)
            @include('site.voluntarios._card')
        @endforeach
    @else
        <p>Nenhum voluntário aqui por enquanto, <strong>seja o primeiro!</strong></p>
    @endif
</div>

@endsection