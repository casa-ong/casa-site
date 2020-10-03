<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Despesa;
use App\Models\User;

class DespesaTest extends TestCase
{

    public function inicializarArrayDespesa($user_id)
    {
        $despesa = Despesa::factory()
            ->create();
        $dados = $despesa->toArray();
        $dados['user_id'] = $user_id;
        return $dados;
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Usuario não logado é redirecionado para tela de login
     * ao tentar acessar rota de adicionar nova enquete
     */
    public function testUsuarioNaoLogadoAcessaFormCriar()
    {
        $response = $this
            ->get('admin/despesa/adicionar')
            ->assertStatus(302);
    }

    public function testVoluntarioAdminLogadoAcessaFormCriar()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);
        $response = $this
            ->actingAs($voluntario)
            ->get('admin/despesa/adicionar')
            ->assertStatus(200);
    }

    public function testUsuarioNaoLogadoEnviaFormCriar()
    {
        $dados = $this->inicializarArrayDespesa('');

        $response = $this
            ->post('admin/despesa/salvar', $dados)
            ->assertStatus(302);
    }

    public function testVoluntarioLogadoEnviaFormCriar()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $dados = $this->inicializarArrayDespesa($voluntario->id);
        $response = $this
            ->actingAs($voluntario)
            ->post('admin/despesa/salvar', $dados)
            ->assertStatus(302)
            ->assertRedirect('admin/despesas')
            ->assertSessionHas('success');
    }

    public function testVoluntarioLogadoEnviaFormIncompletoCriar()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $dados = $this->inicializarArrayDespesa($voluntario->id);
        $dados["descricao"] = "";
        $response = $this
            ->actingAs($voluntario)
            ->post('admin/despesa/salvar', $dados)
            ->assertStatus(302)
            ->assertSessionHas('errors');
    }

    public function testUsuarioNaoLogadoAcessaFormEditar()
    {
        $dados = $this->inicializarArrayDespesa('');

        $response = $this
            ->get('admin/despesa/editar/'.$dados['id'])
            ->assertStatus(302);
    }

    public function testVoluntarioAdminLogadoAcessaFormEditar()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);
        $dados = $this->inicializarArrayDespesa($voluntario->id);

        $response = $this
            ->actingAs($voluntario)
            ->get('admin/despesa/editar/'.$dados['id'])
            ->assertStatus(200);
    }

    public function testUsuarioNaoLogadoEnviaFormEditar()
    {
        $dados = $this->inicializarArrayDespesa('');

        $response = $this
            ->put('admin/despesa/atualizar/'.$dados['id'], $dados)
            ->assertStatus(302);
    }

    public function testVoluntarioLogadoEnviaFormEditar()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $dados = $this->inicializarArrayDespesa($voluntario->id);
        $response = $this
            ->actingAs($voluntario)
            ->put('admin/despesa/atualizar/'.$dados['id'], $dados)
            ->assertStatus(302)
            ->assertRedirect('admin/despesas')
            ->assertSessionHas('success');
    }

    public function testVoluntarioLogadoEnviaFormIncompletoEditar()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $dados = $this->inicializarArrayDespesa($voluntario->id);
        $dados["descricao"] = "";
        $response = $this
            ->actingAs($voluntario)
            ->put('admin/despesa/atualizar/'.$dados['id'], $dados)
            ->assertStatus(302)
            ->assertSessionHas('errors');
    }

    public function testVoluntarioAdminLogadoDeletar()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);
        $dados = $this->inicializarArrayDespesa($voluntario->id);

        $response = $this
            ->actingAs($voluntario)
            ->get('admin/despesa/deletar/'.$dados['id'], $dados)
            ->assertStatus(302)
            ->assertSessionHas('success');

    }

    public function testUsuarioNaoLogadoDeletar()
    {
        $dados = $this->inicializarArrayDespesa('');

        $response = $this
            ->get('admin/despesa/deletar/'.$dados['id'])
            ->assertStatus(302);
    }
}
