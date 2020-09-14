<div class="form-group" id="radio-group-anexo">
    <h2 class="@error('opcao') is-invalid @enderror">{{ $registro->texto }}</h2>
    <p>Escolha uma opção</p>
    @foreach ($registro->opcao as $index => $opcao)
        <label class="radio-option" for="{{ $opcao->id }}">
            <input {{ $registro->is_aberta ? '' : 'disabled' }} type="radio" name="opcao" id="{{ $opcao->id }}" value="{{ $opcao->id }}">
            {{ $opcao->nome }} @auth {{ '('.($opcao->votos ?? '0').' votos)' }} @endauth
            <div width="100px" height="100%" style="background: url('{{ asset($opcao->foto) }}'); background-size: contain" alt=""></div>
        </label>
    @endforeach
    @error('opcao')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>