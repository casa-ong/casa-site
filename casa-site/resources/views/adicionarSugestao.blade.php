@extends('layout.site')
@section('titulo', 'Adicionar sugestão')
@section('anchor', 'sugestoes')

@section('conteudo')
<div class="content">
    <div class="item-title">
        <h1>Envie uma sugestão</h1>

        @if(Session::has('success'))
            <div class="alert alert-success">
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif
        
    </div>
    <div class="item-form">
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