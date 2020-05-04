@extends('layout.site')
@section('titulo', 'Ver sugestão - CASA')

@section('conteudo')
<div class="content">
    <div class="item-title">
        <h1>Ver sugestão</h1>
    </div>
    <div class="item-form">
        <form class="form" action="">
            @include('admin.sugestao._form')
            <div class="input-btn">
                <a class="btn" href="{{ route('admin.sugestao.atualizar', $registro->id) }}" title="Marcar como {!! $registro->lida ? 'não lida' : 'lida' !!}">
                    <span class="far {{ $registro->lida ? 'fa-check-square' : 'fa-square' }}"></span> {{ $registro->lida ? 'Lida' : 'Não lida' }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection