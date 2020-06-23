@extends('layout.site')
@section('titulo', 'Configurar notificações')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1>Configurar notificações</h1>
            @if(Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif
        </div>
        @if(isset($registro))
            <div class="item-form">
                <form action="{{ route('newsletter.atualizar', [$registro->id, $registro->token]) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                    @include('admin.newsletter._form')
                    <div class="input-btn">
                        <button class="btn btn-green">Salvar</button>
                    </div>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection