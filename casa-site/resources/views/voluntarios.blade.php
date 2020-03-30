@extends('layout.site')
@section('titulo', 'Nossos voluntários')

@section('conteudo')
    <div class="content">
        <a class="btn" href="{{ route('site.voluntario.adicionar') }}">Seja um voluntário</a>
        <div style="display: flex; ">
            @foreach ($registros as $registro)
                @if($registro->aprovado)
                    <div class="card-person">
                        <img src="{{ asset($registro->foto) }}" alt="">
                        <h1>{{ $registro->name }}</h1>
                        <p>{{ $registro->profissao }}</p>
                        <p>{{ $registro->descricao }}</p>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection