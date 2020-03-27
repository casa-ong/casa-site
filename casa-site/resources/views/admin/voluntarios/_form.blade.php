<div class="input-field">
    <label for="nome">Nome</label>
    <input type="text" name="name" value="{{ isset($registro->name) ? $registro->name : '' }}" placeholder="Digite aqui o nome do voluntario">
</div>
<div class="input-field">
    <label for="email">CPF</label>
    <input type="text" name="cpf" value="{{ isset($registro->cpf) ? $registro->cpf : '' }}" placeholder="Digite aqui o cpf do voluntario">
</div>
<div class="input-field">
    <label for="email">Profissão</label>
    <input type="text" name="profissao" value="{{ isset($registro->profissao) ? $registro->profissao : '' }}" placeholder="Digite aqui a profissao do voluntario">
</div>
<div class="input-field">
    <label for="nome">Descrição</label>
    <textarea type="text" name="descricao" placeholder="Descreva o voluntario">{{ isset($registro->descricao) ? $registro->descricao : '' }}</textarea>
</div>
<div class="input-field">
    <label for="foto">Foto do voluntario</label>
    <input type="file" name="foto">
</div>
@if(@isset($registro->foto))
    <div class="input-field">
        <img src="{{ asset($registro->foto) }}" alt="">
    </div>    
@endisset
<div class="input-field">
    <label for="email">Email</label>
    <input type="text" name="email" value="{{ isset($registro->email) ? $registro->email : '' }}" placeholder="Digite aqui o email do voluntario">
</div>
<div class="input-field">
    <label for="email">Telefone/Celular</label>
    <input type="text" name="telefone" value="{{ isset($registro->telefone) ? $registro->telefone : '' }}" placeholder="Digite aqui o telefone do voluntario">
</div>
<div class="input-field">
    <label for="password">Senha de acesso</label>
    <input type="password" name="password" value="" placeholder="Digite aqui a senha do voluntario">
</div>
<label class="input-checkbox" for="aprovado">Aprovar esse voluntário da ONG?
    <input type="checkbox" name="aprovado" {{ isset($registro->aprovado) && $registro->aprovado == true ? 'checked' : ''}} value="true">
    <span class="checkmark"></span>
</label>
<label class="input-checkbox" for="admin">Ele deve ser administrador do site?
    <input type="checkbox" name="admin" {{ isset($registro->admin) && $registro->admin == true ? 'checked' : ''}} value="true">
    <span class="checkmark"></span>
</label>

