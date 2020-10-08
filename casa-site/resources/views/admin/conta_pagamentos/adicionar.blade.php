@extends('layout.site')
@section('titulo', 'Nova configuração e sobre | Casa')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1>Informações da Conta Bancária</h1>
        </div>
        <div class="item-form">
            <form action="{{ route('admin.conta_pagamentos.salvar') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                @include('admin.conta_pagamentos._form')

                <div class="input-btn">
                    <button class="btn btn-green">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection