@extends('layout.site')
@section('titulo', 'Adicionar voluntário')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1>Seja voluntário</h1>
        </div>
        <div class="item-form">
            <form action="{{ route('admin.voluntario.salvar') }}" method="POST" enctype="multipart/form-data">
                <p>Preencha os dados a seguir para se tornar um voluntário. É necessário confirmar seu endereço de e-mail após a solicitação e aguardar nosso contato e/ou aprovação. Obrigado pelo interesse em contribuir!</p>
                {{ csrf_field() }}
                @include('admin.voluntarios._form')

                <div class="input-btn">
                    <button class="btn btn-green">Cadastrar-se</button>
                </div>
                <p><strong>Ao se cadastrar-se, você aceita com os <a href="#">nossos termos de privacidade</a></strong></p>
            </form>
        </div>
    </div>
</div>
@endsection