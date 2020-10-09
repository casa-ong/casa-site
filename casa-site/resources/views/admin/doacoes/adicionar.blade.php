@extends('layout.site')
@section('titulo', 'Fazer Doação | Casa')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1>Doações</h1>
            @if(Session::has('success'))
            <div class="alert alert-success" onclick="$(this).toggle('hide')">
                <p>{{ Session::get('success') }}</p>
            </div>
            @endif
        </div>
        <div class="item-form">
            <form action="{{ route('doacao.salvar') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                @include('admin.doacoes._form')

                <div class="input-btn">
                    <button class="btn btn-green">
                        Concluir Doação
                    </button>
                </div>
                
            </form>

                
            
        </div>
    </div>
</div>
@endsection