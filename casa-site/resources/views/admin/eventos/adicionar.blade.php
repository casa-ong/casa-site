@extends('layout.site')
@section('titulo', 'Adicionar evento | Casa')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1>Adicionar evento</h1>
        </div>
        <div class="item-form">
            <form action="{{ route('admin.evento.salvar') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                @include('admin.eventos._form')

                <div class="input-btn">
                    <button class="btn btn-green">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection