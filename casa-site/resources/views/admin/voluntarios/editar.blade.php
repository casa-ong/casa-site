@extends('layout.site')
@section('titulo', 'Editar voluntário')

@section('conteudo')
<div class="content">
    <div class="item-title">
        <h1>Editar voluntário</h1>
    </div>
    <div class="row mt-1 mx-auto">
        <form id="adminForm" action="{{ route('admin.voluntario.aprovar.admin') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="email" value="{{ $registro->email ?? '' }}">

            @if(!$registro->admin || Auth::user()->id == $registro->id)
                <a class="btn m-0-2" href="{{ route('admin.voluntario.aprovar', $registro->id) }}" title="{!! $registro->aprovado ? 'Remove do menu de voluntários do site.' : 'Adiciona ao menu de voluntários do site.' !!}">
                    {{ $registro->aprovado ? 'Ocultar de voluntários' : 'Mostrar em voluntários' }}
                </a>
                <button form="adminForm" class="btn m-0-2" title="{!! $registro->admin ? 'Remove acesso à conta, porém permance sendo voluntário.' : 'Dá privelégios de administrador ao voluntário' !!}" onclick="return confirm('{{ $registro->id == Auth::user()->id ? 'Tem certeza que quer deixar de ser administrador e permanecer apenas como voluntário?' : 'Tem certeza que deseja tornar esse voluntário em administrador? (Esta ação só poderá ser desfeita por ele!)' }}');">
                    {{ $registro->admin ? 'Excluir privilégios' : 'Tornar administrador' }}
                </button>
                <a class="btn m-0-2 btn-danger" href="{{ route('admin.voluntario.deletar',$registro->id) }}" onclick="return confirm('Excluir essa conta permanentemente?');" title="Exclui a conta permanentemente.">
                    <span class="fas fa-trash-alt"></span>
                </a>
            @endif 

        </form>
    </div>
    <div class="item-form">
        <form action="{{ route('admin.voluntario.atualizar', $registro->id) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put">
            @include('admin.voluntarios._form')
            <div class="input-btn">
                <button class="btn">Salvar</button>
            </div>
        </form>
    </div>
</div>
@endsection