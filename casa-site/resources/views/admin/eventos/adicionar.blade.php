@extends('layout.site')
@section('titulo', 'Adicionar evento')

@section('conteudo')
<div class="content">
    <div class="form-title">
        <h1>Adicionar evento</h1>
    </div>
    <div class="form">
        <form action="{{ route('admin.evento.salvar') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('admin.eventos._form')

            <div class="input-btn">
                <button class="btn">Salvar</button>
            </div>
        </form>
    </div>
</div>
@endsection