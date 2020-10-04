@extends('layout.site')
@section('titulo', 'Enquete: '.$registro->texto.' | Casa')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1>Enquete</h1>
        </div>
        @if(Session::has('success'))
            <div class="alert alert-success" onclick="$(this).toggle('hide')">
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif
        @if(!$registro->is_aberta)
            <div class="alert alert-error text-center" onclick="$(this).toggle('hide')">
                <p>Enquete encerrada!</p>
            </div>
        @endif
        <div class="item-form">
            <form action="{{ route('site.enquete.votar', $registro->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put">
                @include('site.enquetes._form')
                @if($registro->is_aberta)
                    <div class="input-btn">
                        <input type="submit" class="btn btn-green" value="Votar">
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection