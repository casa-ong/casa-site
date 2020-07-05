@extends('layout.site')
@section('titulo', 'Lista de Voluntários | Casa')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1 class="">Lista de Voluntários</h1>
            <a class="btn btn-green" href="{{ route('admin.voluntario.adicionar') }}">Novo voluntário</a>
            @if(Session::has('success'))
                <div class="alert alert-success" onclick="$(this).toggle('hide')">
                    <p>{{ Session::get('success') }}</p>
                </div>
            @elseif(Session::has('error'))
                <div class="alert alert-error" onclick="$(this).toggle('hide')">
                    <p>{{ Session::get('error') }}</p>
                </div>
            @endif
        </div>
        <div class="table">
            <table>
                <thead>
                    <tr class="table-header">
                        <th>Ações</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>CPF</th>
                        <th>Projeto</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    
                    @if(isset($registros) && count($registros) > 0)
                        @foreach ($registros as $registro)
                            <tr>
                                <td class="action-cell">
                                    @if(Auth::user()->id != $registro->id)
                                        <a class="btn btn-green" href="{{ route('admin.voluntario.ver', $registro->id) }}" title="Ver">
                                            <span class="fas fa-eye"></span>
                                        </a>
                                    @endif

                                    @if(Auth::user()->id == $registro->id)
                                        <a class="btn btn-green" href="{{ route('admin.voluntario.editar') }}" title="Editar">
                                            <span class="fas fa-pencil-alt"></span>
                                        </a>
                                    @endif

                                </td>
                                <td>{{ $registro->name }}</td>
                                <td title="{{ $registro->email ?? '' }}">{{ mb_strimwidth(strip_tags($registro->email), 0, 15, "...") }}</td>
                                <td>{{ $registro->cpf }}</td>
                                <td>{{ isset($registro->projeto_id) ? $registro->projeto->nome : "Nenhum" }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td height="56px" colspan="5">Nenhum voluntário cadastrado.</td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection