@extends('layout.site')
@section('titulo', 'Adicionar voluntário')

@section('conteudo')
<div class="content">
    <div class="item-title">
        <h1>Seja voluntário</h1>
    </div>
    <div class="item-form">
        <form action="{{ route('admin.voluntario.salvar') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('admin.voluntarios._form')

            <div class="input-btn">
                <button class="btn">Salvar</button>
            </div>
        </form>
    </div>
</div>
@endsection