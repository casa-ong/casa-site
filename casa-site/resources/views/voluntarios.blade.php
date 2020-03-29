@extends('layout.site')
@section('titulo', 'Nossos voluntários')

@section('conteudo')

        <div>
            <a class="btn" href="{{ route('site.voluntario.adicionar') }}">Seja um voluntário</a>
        </div>
        <div class="cards-voluntarios">
            @foreach ($registros as $registro)
                @if($registro->aprovado)
                    <div class="card-voluntario">
                        <img src="{{ asset($registro->foto) }}" alt="">
                        <h1>{{ $registro->name }}</h1>
                        <p>{{ $registro->profissao }}</p>
                        <p>{{ $registro->descricao }}</p>
                    </div>
                @endif
            @endforeach
        </div>
@endsection