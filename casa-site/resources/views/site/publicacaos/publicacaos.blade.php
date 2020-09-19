@extends('layout.site')
@section('titulo', ($tipo == 'evento' ? 'Eventos' : 'Notícias').' | Casa')

@section('conteudo')
<div id="eventos" class="anchor item-title">
    <h1><strong>{{ $tipo == 'evento' ? 'Eventos' : 'Notícias' }}</strong></h1>
</div>
@if(isset($registros) && count($registros) > 0)
    <div class="item border-0">
        @foreach ($registros as $registro)
            @include('site.publicacaos._list')
        @endforeach
    </div>
    <div class="page-nav">
        {{ $registros->links() }}
    </div>
</div>
@else
    <div class="item border-0 text-center">
        <p>Eita, ainda não houve nenhum evento, <strong>cadastre-se abaixo</strong> para saber das novidades por e-mail</p>
    </div>
@endif
@endsection