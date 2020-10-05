<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Doacao;
use App\Models\User;

class DoacaoTest extends TestCase
{
    use RefreshDatabase;
   

    public function inicializarArrayDoacao($conta_pagamento_id = null, $projeto_id = null)
    {
        $doacao = Doacao::factory()
            ->create();

        $dados = $doacao->toArray();
        $dados['conta_pagamento_id'] = $conta_pagamento_id;
        $dados['projeto_id'] = $projeto_id;
        
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

    public function testUsuarioAcessaFormCriar()
    {
        $response = $this
            ->get('doacao/adicionar')
            ->assertStatus(200);
    }

   
    public function testUsuarioEnviaFormCriar()
    {
    
        $dados = $this->inicializarArrayDoacao();

        $response = $this
            ->post('doacao/salvar', $dados)
            ->assertStatus(302)
            ->assertSessionHas('success');
    }

    public function testUsuarioEnviaFormSemValor()
    {
    
        $dados = $this->inicializarArrayDoacao();
        $dados['valor'] = '';
        $response = $this            
            ->post('doacao/salvar', $dados)
            ->assertStatus(302)
            ->assertSessionHas('errors');
    }

    public function testUsuarioEnviaFormSemIsAnonimo()
    {
    
        $dados = $this->inicializarArrayDoacao();
        $dados['is_anonimo'] = '';
        $response = $this            
            ->post('doacao/salvar', $dados)
            ->assertStatus(302)
            ->assertSessionHas('errors');
    }
    
    public function testUsuarioEnviaFormSemComprovanteAnexo()
    {
    
        $dados = $this->inicializarArrayDoacao();
        $dados['comprovante_anexo'] = '';
        $response = $this            
            ->post('doacao/salvar', $dados)
            ->assertStatus(302)
            ->assertSessionHas('errors');
    }

    public function testUsuarioEnviaFormSemMeioPagamento()
    {
    
        $dados = $this->inicializarArrayDoacao();
        $dados['meio_pagamento'] = '';
        $response = $this            
            ->post('doacao/salvar', $dados)
            ->assertStatus(302)
            ->assertSessionHas('errors');
    }    

}
