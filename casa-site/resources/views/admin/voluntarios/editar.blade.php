@extends('layout.site')
@section('titulo', 'Minha conta | Casa')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1>Minha conta</h1>
            @if (session('status'))
                <div class="alert alert-success" role="alert" onclick="$(this).toggle('hide')">
                    <p>{{ session('status') }}</p>
                </div>
            @endif
        </div>
        <div class="row mt-1 mx-auto">
            
            @if(Auth::user()->id == $registro->id)
                @if($registro->admin)
                    <a class="btn btn-green m-0-2" href="{{ route('admin.voluntario.aprovar', $registro->id) }}" title="{!! $registro->aprovado ? 'Remove do menu de voluntários do site.' : 'Adiciona ao menu de voluntários do site.' !!}">
                        {{ $registro->aprovado ? 'Ocultar de voluntários' : 'Mostrar em voluntários' }}
                    </a>
                    <form id="adminForm" action="{{ route('admin.voluntario.aprovar.admin') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="email" value="{{ $registro->email ?? '' }}">
                        <button form="adminForm" class="btn btn-green m-0-2" title="{!! $registro->admin ? 'Remove acesso à conta, porém permance sendo voluntário.' : 'Dá privelégios de administrador ao voluntário' !!}" onclick="return confirm('{{ $registro->id == Auth::user()->id ? 'Tem certeza que quer deixar de ser administrador e permanecer apenas como voluntário?' : 'Tem certeza que deseja tornar esse voluntário em administrador? (Esta ação só poderá ser desfeita por ele!)' }}');">
                            {{ $registro->admin ? 'Excluir privilégios' : 'Tornar administrador' }}
                        </button>
                    </form>
                @endif
                <form id="alterarSenhaForm" action="{{ route('password.email') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="email" value="{{ $registro->email ?? '' }}">
                    <button form="alterarSenhaForm" class="btn btn-green m-0-2" onclick="return confirm('Você receberá um email com o link para resetar sua senha, certo?');">
                        Alterar senha
                    </button>
                </form>
                <a class="btn m-0-2 btn-danger" href="{{ route('admin.voluntario.deletar',$registro->id) }}" onclick="return confirm('Excluir essa conta permanentemente?');" title="Exclui a conta permanentemente.">
                    <span class="fas fa-trash-alt"></span>
                </a>
            @endif 

        </div>
        <div class="item-form">
            <form action="{{ route('admin.voluntario.atualizar', $registro->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put">
                @include('admin.voluntarios._form')
                <div class="input-btn">
                    <button class="btn btn-green">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection