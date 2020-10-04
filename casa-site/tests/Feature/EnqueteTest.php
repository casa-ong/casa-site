<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Enquete;
use App\Models\Opcao;

class EnqueteTest extends TestCase
{
    use RefreshDatabase;

    public function inicializarArrayEnquete($user_id, $is_aberta = true)
    {
        $enquete = Enquete::factory()
            ->hasOpcao(2)
            ->create([
                'is_aberta' => $is_aberta,
            ]);

        $dados = $enquete->toArray();
        $dados['user_id'] = $user_id;

        $dados['opcao'][0] = 'Opcao 1';
        $dados['opcao'][1] = 'Opcao 2';
        
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
            ->get('admin/enquete/adicionar')
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
            ->get('admin/enquete/adicionar')
            ->assertStatus(200);
    }

    public function testUsuarioNaoLogadoEnviaFormCriar()
    {
        $dados = $this->inicializarArrayEnquete('');

        $response = $this
            ->post('admin/enquete/salvar', $dados)
            ->assertStatus(302);
    }

    /**
     * Voluntario é redirecionado para tela de lista de enquetes
     * ao criar uma nova enquete
     */
    public function testVoluntarioLogadoEnviaFormCriar()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $dados = $this->inicializarArrayEnquete($voluntario->id);

        $response = $this
            ->actingAs($voluntario)
            ->post('admin/enquete/salvar', $dados)
            ->assertStatus(302)
            ->assertRedirect('admin/enquetes')
            ->assertSessionHas('success');
    }

    /**
     * Voluntario é redirecionado para tela de lista de enquetes
     * ao criar uma nova enquete
     */
    public function testVoluntarioLogadoEnviaFormCriarIncompleto()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $dados = $this->inicializarArrayEnquete($voluntario->id);
        $dados['opcao'][0] = '';

        $response = $this
            ->actingAs($voluntario)
            ->post('admin/enquete/salvar', $dados)
            ->assertStatus(302)
            ->assertSessionHas('errors');
    }

    public function testUsuarioNaoLogadoEnviaFormAtualizar()
    {
        $dados = $this->inicializarArrayEnquete('');

        $response = $this
            ->get('admin/enquete/atualizar/'.$dados['id'])
            ->assertStatus(302);
    }

    /**
     * Voluntario é redirecionado para tela de lista de enquetes
     * ao atualizar uma enquete
     */
    public function testVoluntarioLogadoEnviaFormAtualizar()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $dados = $this->inicializarArrayEnquete($voluntario->id);

        $response = $this
            ->actingAs($voluntario)
            ->get('admin/enquete/atualizar/'.$dados['id'])
            ->assertStatus(302)
            ->assertSessionHas('success');
    }

    /**
     * Voluntario é redirecionado para tela de lista de enquetes
     * ao criar uma nova enquete
     */
    public function testUsuarioNaoLogadoDeletar()
    {
        $dados = $this->inicializarArrayEnquete('');

        $response = $this
            ->get('admin/enquete/deletar/'.$dados['id'])
            ->assertStatus(302);
    }

    /**
     * Voluntario é redirecionado para tela de lista de enquetes
     * ao criar uma nova enquete
     */
    public function testVoluntarioLogadoDeletar()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $dados = $this->inicializarArrayEnquete($voluntario->id);

        $response = $this
            ->actingAs($voluntario)
            ->get('admin/enquete/deletar/'.$dados['id'])
            ->assertStatus(302)
            ->assertSessionHas('success');
    }

    public function testUsuarioVerEnqueteAberta()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $dados = $this->inicializarArrayEnquete($voluntario->id);

        $response = $this
            ->get('/site/enquete/'.$dados['id'])
            ->assertStatus(200);
    }

    public function testUsuarioVotaEnqueteAberta()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $enquete = $this->inicializarArrayEnquete($voluntario->id);
        $opcao = Opcao::where('enquete_id', $enquete['id'])->first();

        $dados = [];
        $dados['opcao'] = $opcao->id;

        $dados['g-recaptcha-response'] = 'any';

        $response = $this
            ->put('/site/enquete/votar/'.$enquete['id'], $dados)
            ->assertStatus(302)
            ->assertSessionHas('success');
    }

    public function testUsuarioVotaEnqueteAbertaOpcaoInexistente()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $enquete = $this->inicializarArrayEnquete($voluntario->id);

        $dados = [];
        $dados['opcao'] = 0;

        $dados['g-recaptcha-response'] = 'any';

        $response = $this
            ->put('/site/enquete/votar/'.$enquete['id'], $dados)
            ->assertStatus(302)
            ->assertSessionHas('errors');
    }

    public function testUsuarioVerEnqueteFechada()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $dados = $this->inicializarArrayEnquete($voluntario->id, false);
        $dados['is_aberta'] = false;

        $response = $this
            ->get('/site/enquete/'.$dados['id'])
            ->assertStatus(404);
    }

    public function testUsuarioVotaEnqueteFechada()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $enquete = $this->inicializarArrayEnquete($voluntario->id, false);
        $opcao = Opcao::where('enquete_id', $enquete['id'])->first();

        $dados = [];
        $dados['opcao'] = $opcao->id;

        $dados['g-recaptcha-response'] = 'any';

        $response = $this
            ->put('/site/enquete/votar/'.$enquete['id'], $dados)
            ->assertStatus(405);
    }

    public function testVoluntarioAdminLogadoVerEnqueteFechada()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $dados = $this->inicializarArrayEnquete($voluntario->id);

        $response = $this
            ->actingAs($voluntario)
            ->get('/site/enquete/'.$dados['id'])
            ->assertStatus(200);
    }
    
}
