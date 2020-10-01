<h1 class="mb">Seja <strong>voluntário</strong></h1>
<div class="card form-card">
    <form id="form-btn-vol" action="{{ route('site.home.voluntario.adicionar') }}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}
        <div class="input-field">
            <label for="email">Digite seu e-mail para começar</label>
            <input class="{{ $errors->has('email') ? 'error' : '' }}" name="email" type="text" placeholder="Digite seu email para se cadastrar" value="{{ old('email') }}">
            @error('email')
                <p class="error" form="form-btn-vol">{{ $message }}</p>
            @enderror
            <button form="form-btn-vol" type="submit" class="btn btn-green">Cadastrar-se</button>
        </div>
    </form>
</div>