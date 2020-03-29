@extends('layout.site')
@section('titulo', 'Adicionar notícia')

@section('conteudo')
    <div class="form-title">
        <h1>Adicionar notícia</h1>
    </div>
    <div class="form">
        <form action="{{ route('admin.noticia.salvar') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('admin.noticias._form')

            <div class="input-btn">
                <button class="btn">Salvar</button>
            </div>
        </form>

    </div>
@endsection