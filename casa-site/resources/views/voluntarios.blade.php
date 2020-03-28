@extends('layout.site')
@section('titulo', 'Lista de Projetos')

@section('conteudo')

        <div class="cards-voluntarios">
            @foreach ($registros as $registro)
                <div class="card-voluntario">
                    <img src="{{ $registro->foto }}" alt="">
                    <h1>{{ $registro->name }}</h1>
                    <p>{{ $registro->profissao }}</p>
                    <p>{{ $registro->descricao }}</p>
                </div>
            @endforeach
        </div>
@endsection