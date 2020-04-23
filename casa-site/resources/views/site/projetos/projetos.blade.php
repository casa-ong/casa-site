@extends('layout.site')
@section('titulo', 'Projetos - CASA')

@section('conteudo')

<div id="projetos" class="item-title">
    <h1>Nossos projetos</h1>
</div>
<div class="item" style="border: 0px">
    @if(isset($projetos) && count($projetos) > 0)
        @foreach ($projetos as $projeto)
            @include('site.projetos._card')
        @endforeach
    @else
        <p>Poxa, nossos projetos ainda não foram cadastrados...</p>
    @endif
</div>
<div class="content-footer">
    <div class="page-nav">
        {{ $projetos->links() }}
    </div>
</div>
@endsection