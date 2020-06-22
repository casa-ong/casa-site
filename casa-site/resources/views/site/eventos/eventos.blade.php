@extends('layout.site')
@section('titulo', 'Eventos | Casa')

@section('conteudo')
<div id="eventos" class="anchor item-title">
    <h1><strong>Eventos</strong></h1>
</div>
@if(isset($eventos) && count($eventos) > 0)
    <div class="item border-0">
        @foreach ($eventos as $evento)
            @include('site.eventos._list')
        @endforeach
    </div>
    <div class="page-nav">
        {{ $eventos->links() }}
    </div>
</div>
@else
    <div class="item border-0 text-center">
        <p>Eita, ainda não houve nenhum evento, <strong>cadastre-se abaixo</strong> para saber das novidades por e-mail</p>
    </div>
@endif
@endsection