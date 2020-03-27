@extends('layout.site')
@section('titulo', 'Adicionar projeto')

@section('conteudo')
    <div class="form-title">
        <h1>Adicionar projeto</h1>
    </div>
    <div class="form">
        <form action="{{ route('admin.projeto.salvar') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('admin.projetos._form')

            <div class="input-btn">
                <button class="btn">Salvar</button>
            </div>
        </form>

    </div>
@endsection