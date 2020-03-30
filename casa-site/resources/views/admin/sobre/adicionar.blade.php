@extends('layout.site')
@section('titulo', 'Nova configuração e sobre')

@section('conteudo')
<div class="content">
    <div class="form-title">
        <h1>Nova configuração e sobre</h1>
    </div>
    <div class="form">
        <form action="{{ route('admin.sobre.salvar') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('admin.sobre._form')

            <div class="input-btn">
                <button class="btn">Salvar</button>
            </div>
        </form>
    </div>
</div>
@endsection