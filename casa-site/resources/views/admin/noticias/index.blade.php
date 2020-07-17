@extends('layout.site')
@section('titulo', 'Lista de notícias | Casa')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1 class="">Lista de notícias</h1>
            <a class="btn btn-green" href="{{ route('admin.noticia.adicionar') }}">Nova notícia</a>
            @if(Session::has('success'))
                <div class="alert alert-success" onclick="$(this).toggle('hide')">
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif
        </div>

        <div class="table">
            <table>
                <thead>
                    <tr class="table-header">
                        <th width="20%">Ações</th>
                        <th width="55%">Título</th>
                        <th width="25%">
                            <label for="dropdown" class="btn-dropdown">
                                @if($lista['all'])
                                Status&nbsp;(Todos)
                                @elseif($lista['drafts'])
                                Status&nbsp;(Rasc.)
                                    @elseif($lista['public'])
                                    Status&nbsp;(Publi.)
                                    @endif
                                    <i class="fas fa-caret-down"></i>
                                    <input type="checkbox" class="dropdown" id="dropdown">
                                    <div id="dropdown-links" class="dropdown-links">
                                        {!! !$lista['all'] ? '<a href="'.route('admin.noticias').'">Todos</a>' : '' !!}
                                        {!! !$lista['drafts'] ? '<a href="'.route('admin.noticias.rascunhos').'">Rascunhos</a>' : '' !!}
                                        {!! !$lista['public'] ? '<a href="'.route('admin.noticias.publicados').'">Publicados</a>' : '' !!}
                                    </div>
                                </label>
                        </th>
                    </tr>
                </thead>
                <tbody class="table-body">

                    @if(isset($registros) && count($registros) > 0)
                        @foreach ($registros as $registro)
                            <tr>
                                <td class="action-cell">
                                    <a class="btn btn-green" href="{{ route('admin.noticia.editar',$registro->id) }}" title="Editar">
                                        <span class="fas fa-pencil-alt"></span>
                                    </a>
                                    <a class="btn btn-danger" href="{{ route('admin.noticia.deletar',$registro->id) }}" onclick="return confirm('Tem certeza que deseja deletar o projeto?');" title="Deletar">
                                        <span class="fas fa-trash-alt"></span>
                                    </a>
                                </td>
                                <td>{{ $registro->titulo }}</td>
                                <td>{{ $registro->publicado ? "Sim" : "Não" }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td height="56px" colspan="3">Ainda não há notícias{{ $lista['all'] ? '' : '' }}{{ $lista['drafts'] ? ' rascunhos' : '' }}{{ $lista['public'] ? ' publicadas' : ''}}.</td>
                        </tr>
                    @endif
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection