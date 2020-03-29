@extends('layout.site')
@section('titulo', 'Adicionar voluntário')

@section('conteudo')
    <div class="form-title">
        <h1>Seja voluntário</h1>
    </div>
    <div class="form">
        <form action="{{ route('admin.voluntario.salvar') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('admin.voluntarios._form')

            <div class="input-btn">
                <button class="btn">Salvar</button>
            </div>
        </form>

    </div>
@endsection