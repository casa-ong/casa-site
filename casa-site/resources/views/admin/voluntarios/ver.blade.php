@extends('layout.site')
@section('titulo', 'Dados do voluntário - '.config('APP_NAME', 'CASA'))

@section('conteudo')
<div class="content">
    <div class="item-title">
        @if((Auth::user()->id ?? null) == $registro->id)
            <h1>Minha conta</h1>
        @else
            <h1>Dados do voluntário</h1>
        @endif
    </div>
    <div class="w-text mx-auto border-1">
        <div class="row align-center">
            <img class="user-profile mt-1" src="{{ asset($registro->foto ?? '/img/voluntarios/user_profile.png') }}" alt="">
        </div>
        <div class="item py-0 border-0">
            <p>
                <strong>{{ $registro->name }}</strong> tem 
                <strong>{{ $registro->getAge() }} anos</strong>
                e mora {!! isset($registro->cidade) ? 'em <strong>'.$registro->cidade.'</strong>' : '' !!}
                {!! 'no estado de <strong>'.$registro->estado.'</strong>' !!}, trabalha como 
                <strong>{{ $registro->profissao }}</strong> 
                {!! isset($registro->projeto->id) ? 'e participa do projeto <a href="'.route('site.projeto', $registro->projeto->id).'">'.$registro->projeto->nome.'</a>.' : '.' !!}
                {!! Auth::user() ? 'Seu e-mail para contato é <strong>'.$registro->email.'</strong> e o seu número de telefone é <strong>'.$registro->telefone.'</strong>.' : '' !!}
                Na sua descrição <strong>{{ $registro->name }}</strong> diz "{{ $registro->descricao }}".
            </p>
        </div>
    </div>
    <div class="row mt-1 mx-auto">
        <form class="row" id="adminForm" action="{{ route('admin.voluntario.aprovar.admin') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="email" value="{{ $registro->email ?? '' }}">

            @if(!Auth::guest() && (!$registro->admin || Auth::user()->id == $registro->id))
                <a class="btn m-0-2" href="{{ route('admin.voluntario.aprovar', $registro->id) }}" title="{!! $registro->aprovado ? 'Remove do menu de voluntários do site.' : 'Adiciona ao menu de voluntários do site.' !!}">
                    {{ $registro->aprovado ? 'Ocultar de voluntários' : 'Mostrar em voluntários' }}
                </a>
                <button form="adminForm" class="btn m-0-2" title="{!! $registro->admin ? 'Remove acesso à conta, porém permance sendo voluntário.' : 'Dá privelégios de administrador ao voluntário' !!}" onclick="return confirm('{{ $registro->id == (Auth::user()->id ?? '') ? 'Tem certeza que quer deixar de ser administrador e permanecer apenas como voluntário?' : 'Tem certeza que deseja tornar esse voluntário em administrador? (Esta ação só poderá ser desfeita por ele!)' }}');">
                    <span class="fas {{ $registro->admin ? 'fa-lock' : 'fa-unlock' }}"></span> {{ $registro->admin ? 'Excluir privilégios' : 'Tornar administrador' }}
                </button>
                <a class="btn m-0-2 btn-danger" href="{{ route('admin.voluntario.deletar',$registro->id) }}" onclick="return confirm('Excluir essa conta permanentemente?');" title="Exclui a conta permanentemente.">
                    <span class="fas fa-trash-alt"></span>
                </a>
            @endif 

        </form>
    </div>
</div>
@endsection