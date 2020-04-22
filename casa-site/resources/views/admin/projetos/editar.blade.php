@extends('layout.site')
@section('titulo', 'Editar projeto')

@section('conteudo')
<div class="content">
    <div class="item-title">
        <h1>Editar projeto</h1>
    </div>
    <div class="item-form">
        <form action="{{ route('admin.projeto.atualizar', $registro->id) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put">
            @include('admin.projetos._form')
            <div class="input-btn">
                <button class="btn">Salvar</button>
            </div>
        </form>
    </div>
</div>
@endsection