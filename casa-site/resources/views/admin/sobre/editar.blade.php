@extends('layout.site')
@section('titulo', 'Editar configuração e sobre')

@section('conteudo')
<div class="content">
    <div class="form-title">
        <h1>Editar configuração e sobre</h1>
    </div>
    <div class="form">
        <form action="{{ route('admin.sobre.atualizar', $registro->id) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put">
            @include('admin.sobre._form')
            <div class="input-btn">
                <button class="btn">Salvar alterações</button>
            </div>
        </form>
    </div>
</div>
@endsection