@extends('layout.site')
@section('titulo', 'Nossos projetos | Casa')

@section('conteudo')

<div id="projetos" class="anchor item-title">
    <h1>Nossos <strong>projetos</strong></h1>
</div>
@if(isset($projetos) && count($projetos) > 0)
    <div class="item border-0">
        @foreach ($projetos as $projeto)
            @include('site.projetos._list')
        @endforeach
    </div>
    <div class="content-footer">
        <div class="page-nav">
            {{ $projetos->links() }}
        </div>
    </div>
@else
    <div class="item border-0 text-center">
        <p>Oxente, nossos projetos ainda não foram cadastrados,<br><strong>cadastre-se abaixo</strong> para saber quando houver novos projetos!</p>
    </div>
@endif
@endsection