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
                    <input name="rascunho" type="submit" class="btn btn-white" value="Salvar como rascunho">
                    <input name="publicar" type="submit" class="btn btn-green" value="Publicar agora">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection