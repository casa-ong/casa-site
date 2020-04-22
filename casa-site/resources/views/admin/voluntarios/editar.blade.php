@extends('layout.site')
@section('titulo', 'Editar voluntário')

@section('conteudo')
<div class="content">
    <div class="item-title">
        <h1>Editar voluntário</h1>
    </div>
    <div class="item-form">
        <form action="{{ route('admin.voluntario.atualizar', $registro->id) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put">
            @include('admin.voluntarios._form')
            <div class="input-btn">
                <button class="btn">Salvar</button>
            </div>
        </form>
    </div>
</div>
@endsection