@extends('layout.site')
@section('titulo', 'Adicionar sugestão')

@section('conteudo')
<div class="content">
    <div class="form-title">
        <h1>Envie uma sugestão</h1>
    </div>
    <div class="form">
        <form action="{{ route('sugestao.salvar') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('admin.sugestao._form')

            <div class="input-btn">
                <button class="btn">Salvar</button>
            </div>
        </form>
    </div>
</div>
@endsection