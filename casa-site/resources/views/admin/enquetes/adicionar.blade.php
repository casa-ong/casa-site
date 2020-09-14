@extends('layout.site')
@section('titulo', 'Criar enquete | Casa')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1>Criar enquete</h1>
        </div>
        <div class="item-form">
            <form action="{{ route('admin.enquete.salvar') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                @include('admin.enquetes._form')

                <div class="input-btn">
                    <input name="rascunho" type="submit" class="btn btn-white" value="Salvar enquete fechada">
                    <input name="publicar" type="submit" class="btn btn-green" value="Salvar e publicar enquete">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection