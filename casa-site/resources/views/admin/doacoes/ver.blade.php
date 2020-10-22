@extends('layout.site')
@section('titulo', 'Ver Doação | CASA')

@section('conteudo')
<div class="post">
    <div class="content main">
        <div class="item-title">
            <h1>Ver doação</h1>
        </div>
        <div class="item-form">
            <form class="form" action="">
                @include('admin.doacoes._form')
                <div class="input-btn">

                    @if(isset($registro->comprovante_anexo))
                        <a class="btn btn-green" href="{{ asset($registro->comprovante_anexo) }}" alt="" download="baixar">Baixar anexo</a>
                    @else
                        <div class="input-field">
                            <label>Anexo Comprovante:</label>
                            <input type="file" name="comprovante_anexo">
                            @error('comprovante_anexo')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>
                    @endif

                    @auth
                        <a class="btn btn-green" href="{{ route('admin.doacao.aprovar', $registro->id) }}" title="Aprovar Doação!!">
                            <span class="far {{ $registro->is_aprovado? 'fa-check-square' : 'fa-square' }}"></span> {{ 'Aprovar' }}
                        </a>
                    @endauth
                </div>
            </form>
        </div>
    </div>
</div>
@endsection