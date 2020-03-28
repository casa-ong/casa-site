@extends('layout.site')
@section('titulo', 'Nova configuração')

@section('conteudo')
    <div class="form-title">
        <h1>Nova configuração</h1>
    </div>
    <div class="form">
        <form action="{{ route('admin.dados_site.atualizar', $registro->id) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put">
            @include('admin.dados_site._form')
            <div class="input-btn">
                <button class="btn">Republicar</button>
            </div>
        </form>

    </div>
@endsection