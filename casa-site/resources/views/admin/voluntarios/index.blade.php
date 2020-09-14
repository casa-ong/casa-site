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
        <div class="item-actions">
            <div class="filter-input ml-auto">
                <input id="pesquisaVoluntarios" type="search" placeholder="Filtrar por nome...">
            </div>
        </div>
        <div class="table">
            <table>
                <thead>
                    <tr class="table-header">
                        <th>Ações</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Projeto</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="table-body" id="tableVoluntarios">
                    
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
                                        <a class="btn btn-green" href="{{ route('admin.voluntario.editar', $registro->id) }}" title="Editar">
                                            <span class="fas fa-pencil-alt"></span>
                                        </a>
                                    @endif

                                </td>
                                <td>{{ $registro->name }}</td>

                                @if(isset($registro->email_verified_at))
                                    <td title="{{ $registro->email ?? '' }}">{{ mb_strimwidth(strip_tags($registro->email), 0, 15, "...") }}</td>
                                @else
                                    <td style="color: red; cursor: pointer;" title="E-mail não verificado, clique no botão de ver voluntário e reenvie o e-mail de verificação." class="error">Não verificado</td>
                                @endif
                                <td>{{ isset($registro->projeto_id) ? $registro->projeto->nome : "Nenhum" }}</td>
                                <td>
                                    @if($registro->admin)
                                        <span title="Voluntário administrador" class="fas fa-crown" style="color: orange;"></span>
                                    @else
                                        {!! $registro->aprovado ? '<span title="Voluntário aprovado" class="fas fa-user-check"></span>' : '<span title="Aprovação do voluntário pendente" class="fas fa-exclamation-triangle" style="color: red;"></span>' !!}
                                    @endif
                                </td>
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

@section('scripts')

    <script src="{{ asset('js/filtro_voluntario.js') }}"></script>

@endsection