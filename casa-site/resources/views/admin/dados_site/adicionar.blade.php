@extends('layout.site')
@section('titulo', 'Nova configuração')

@section('conteudo')
    <div class="form-title">
        <h1>Nova configuração</h1>
    </div>
    <div class="form">
        <form action="{{ route('admin.dados_site.salvar') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('admin.dados_site._form')

            <div class="input-btn">
                <button class="btn">Salvar</button>
            </div>
        </form>

    </div>
@endsection