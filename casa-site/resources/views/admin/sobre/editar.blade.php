@extends('layout.site')
@section('titulo', 'Editar configuração e sobre')

@section('conteudo')
<div class="content">
    <div class="item-title">
        <h1>Editar configuração e sobre</h1>
    </div>
    <div class="item-form">
        <form action="{{ route('admin.sobre.atualizar', $registro->id) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put">
            @include('admin.sobre._form')
            <div class="input-btn">
                <button class="btn">Salvar</button>
            </div>
        </form>
    </div>
</div>
@section('script')
    <script>
        $(document).ready(function(){
            $("img").addClass("img-responsive");
            $("img").css("max-width", "100%");
        });
    </script>
@endsection
@endsection