<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Enquete;

class EnqueteTest extends TestCase
{

    public function inicializarArrayEnquete()
    {
        $enquete = Enquete::factory()
            ->hasOpcao(3)
            ->make();

        $dados = $enquete->toArray();
        
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
    public function testVoluntarioNaoLogadoAcessaForm()
    {
        $response = $this
            ->get('admin/enquete/adicionar')
            ->assertStatus(302);
    }

    public function testVoluntarioAdminLogadoAcessaForm()
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

    public function testVoluntarioNaoLogadoEnviaForm()
    {
        $dados = $this->inicializarArrayEnquete();

        $response = $this
            ->post('admin/enquete/salvar', $dados)
            ->assertStatus(302);
    }


}
