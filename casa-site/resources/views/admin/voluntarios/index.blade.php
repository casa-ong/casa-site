@extends('layout.site')
@section('titulo', 'Lista de Voluntários')

@section('conteudo')
<div class="content">
        <div class="item-title">
            <h1 class="">Lista de Voluntários</h1>
            <a class="btn" href="{{ route('admin.voluntario.adicionar') }}">Adicionar</a>
            @if(Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif
        </div>
        <div class="table">
            <table>
                <thead>
                    <tr class="table-header">
                        <th>Nome</th>
                        <th>Email</th>
                        <th>CPF</th>
                        <th>Projeto</th>
                        <th style="cursor: help;" title="O voluntário aprovado aparecerá no mapa de voluntários do site">Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @foreach ($registros as $registro)
                        <tr>
                            <td>{{ $registro->name }}</td>
                            <td>{{ $registro->email }}</td>
                            <td>{{ $registro->cpf }}</td>
                            <td>{{ isset($registro->projeto_id) ? $registro->projeto->nome : "Nenhum" }}</td>
                            <td>
                                @if( !$registro->admin || Auth::user()->id == $registro->id)
                                    <a class="btn" href="{{ route('admin.voluntario.aprovar', $registro->id) }}" title="Marcar como {!! $registro->aprovado ? 'não aprovado' : 'aprovado' !!}">
                                        <span class="far {{ $registro->aprovado ? 'fa-check-square' : 'fa-square' }}"></span><br>{{ $registro->aprovado ? 'Aprovado' : 'Não aprovado' }}
                                    </a>
                                @else 
                                    <p>Administrador</p>
                                @endif
                            </td>
                            <td class="action-cell">
                                @if( !$registro->admin || Auth::user()->id == $registro->id)
                                    <a class="btn" href="{{ route('admin.voluntario.editar') }}" title="Editar">
                                        <span class="fas fa-pencil-alt"></span>
                                    </a>
                                    <a class="btn btn-danger" href="{{ route('admin.voluntario.deletar',$registro->id) }}" onclick="return confirm('Tem certeza que deseja deletar o voluntario?');" title="Deletar">
                                        <span class="fas fa-trash-alt"></span>
                                    </a>
                                @else
                                    <p>Nenhuma</p>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection