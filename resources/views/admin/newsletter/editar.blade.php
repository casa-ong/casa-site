@extends('layout.site')
@section('titulo', 'Configurações de notificações | Casa')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1>Configurar notificações</h1>
            @if(Session::has('success'))
                <div class="alert alert-success" onclick="$(this).toggle('hide')">
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
        @else
            <div class="item-form">
                <p>Nenhuma configuração de e-mail foi encontrada.</p>
            </div>
        @endif
    </div>
</div>
@endsection