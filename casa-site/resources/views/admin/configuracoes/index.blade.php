@extends('layout.site')
@section('titulo', 'Configurações | Casa')
@section('anchor', 'controle')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1 class=""><strong>Configurações</strong></h1>
        </div>
        <div class="item" style="border-bottom: 0;">
            <a class="admin-card" href="{{ route('admin.sobre') }}">
                <span class="fas fa-cog"></span>
                <h2>Sobre</h2>
            </a>
            <a class="admin-card" href="{{ route('admin.conta_pagamentos') }}">
                <span class="fas fa-dollar-sign"></span>
                <h2>Conta Bancária</h2>
            </a>
            <a class="admin-card" href="#">
                <span class="fas fa-address-book"></span>
                <h2>Contatos *Em Breve*</h2>
            </a>
        </div>
    </div>
</div>
@endsection
