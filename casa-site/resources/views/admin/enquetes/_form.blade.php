<input type="hidden" name="user_id" value="{{ Auth::id() }}">

@if(isset($registro))
    <p>Esta enquete está <strong>{{ isset($registro->is_aberta) && $registro->is_aberta == true ? 'aberta' : 'fechada'}}.</strong></p>
@endif

<div class="input-field">
    <label for="texto">Texto da enquete*</label>
    <input class="{{ $errors->has('texto') ? 'error' : '' }}" type="text" name="texto" value="{{ isset($registro->texto) ? $registro->texto : old('texto') }}">
    @error('texto')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="input-field" id="opcoes">
    <label for="opcaos">Opções*</label>
    <div class="opcao-group" id="opcaoClone">
        <input class="{{ $errors->has('opcao.1') ? 'error' : '' }}" type="text" name="opcao[]" placeholder="Opção 1 da enquete" value="{{ isset($registro->opcao[0]) ? $registro->opcao[0]->nome : old('opcao.0') }}">
        <input type="file" name="foto[]">
    </div>
    <div class="opcao-group">
        <input class="{{ $errors->has('opcao.2') ? 'error' : '' }}" type="text" name="opcao[]" placeholder="Opção 2 da enquete" value="{{ isset($registro->opcao[1]) ? $registro->opcao[1]->nome : old('opcao.1') }}">
        <input type="file" name="foto[]" id="">
    </div>
    @for ($i = 2; old('opcao.'.$i) != null; $i++)
        <div class="opcao-group">
            <input class="{{ $errors->has('opcao.'.$i) ? 'error' : '' }}" type="text" name="opcao[]" placeholder="Opção 2 da enquete" value="{{ isset($registro->opcao[$i]) ? $registro->opcao[$i]->nome : old('opcao.'.$i) }}">
            <input type="file" name="foto[]" id="">
        </div>
    @endfor
    @error('opcao.*')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="input-btn">
    <button type="button" class="btn btn-green" id="maisOpcoes" title="Mais opções">
        <span class="fa fa-plus"></span>
    </button>
</div>

@section('scripts')

    <script>
        document.getElementById("maisOpcoes").addEventListener("click", function() {
            var opcao = document.getElementById("opcaoClone").cloneNode(true);
            opcao.childNodes[1].placeholder = "";
            opcao.childNodes[1].value = "";
            document.querySelector("#opcoes").appendChild(opcao);
        });
    </script>

@endsection
