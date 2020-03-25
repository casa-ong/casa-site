@extends('layout.site')
@section('titulo', 'Lista de Projetos')

@section('conteudo')
    <div class="form-title">
        <h1>Editar projeto</h1>
    </div>
    <div class="form">
        <form action="{{ route('admin.projeto.atualizar', $registro->id) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put">
            @include('admin.projetos._form')
            <div class="input-btn">
                <button class="btn">Salvar</button>
            </div>
        </form>

    </div>
@endsection