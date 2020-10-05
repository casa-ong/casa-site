@extends('layout.site')
@section('titulo', 'Fazer Doação | Casa')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1>Doações</h1>
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