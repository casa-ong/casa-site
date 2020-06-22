@extends('layout.site')
@section('titulo', 'Adicionar sugestão')
@section('anchor', 'sugestoes')

@section('conteudo')
<div class="post">
    <div class="content main">
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
                    <button class="btn btn-green">Salvar</button>
                </div>
            </form>
        </div>
    </div>
    <section class="sidebar">
        @include('site._includes._novo_voluntario_sidebar')
    </section>
</div>
@endsection