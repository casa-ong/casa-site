@extends('layout.site')
@section('titulo', 'Projetos - CASA')

@section('conteudo')

<div id="projetos" class="item-title">
    <h1>Nossos projetos</h1>
</div>
<div class="item" style="border: 0px">
    @foreach ($projetos as $projeto)
        @include('site.projetos._card')
    @endforeach
</div>
<div class="page-nav">
    {{ $projetos->links() }}
</div>
@endsection