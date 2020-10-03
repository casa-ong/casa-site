@extends('layout.site')
@section('titulo', 'Editar despesa | Casa')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1>Editar despesa</h1>
        </div>
        <div class="item-form">
            <form action="{{ route('admin.despesa.atualizar', $registro->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put">
                @include('admin.despesas._form')
                <div class="input-btn">
                    <input name="rascunho" type="submit" class="btn btn-white" value="Salvar como rascunho">
                    <input name="publicar" type="submit" class="btn btn-green" value="Publicar agora">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection