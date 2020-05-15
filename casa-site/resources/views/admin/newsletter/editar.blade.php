@extends('layout.site')
@section('titulo', 'Editar newsletter')

@section('conteudo')
<div class="content">
    <div class="item-title">
        <h1>Editar newsletter</h1>
    </div>
    <div class="item-form">
        <form action="{{ route('admin.newsletter.atualizar', $registro->id) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put">
            @include('admin.newsletter._form')
            <div class="input-btn">
                <button class="btn">Salvar</button>
            </div>
        </form>
    </div>
</div>
@endsection