@extends('layout.site')
@section('titulo', 'Nova configuração e sobre | Casa')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1>Nova configuração e sobre</h1>
        </div>
        <div class="item-form">
            <form action="{{ route('admin.sobre.salvar') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                @include('admin.sobre._form')

                <div class="input-btn">
                    <button class="btn btn-green">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection