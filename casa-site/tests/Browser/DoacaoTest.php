<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Doacao;
use App\Models\ContaPagamento;
use Illuminate\Support\Str;

class DoacaoTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Laravel');
        });
    }

    public function testUsuarioNaoLogadoAcessarFormFazerDoacao()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Saiba como');

        });
    }

    public function testUsuarioNaoLogadoFazerDoacao()
    {
        $doacao = Doacao::factory()->create();

        $this->browse(function (Browser $browser) {
            $browser->visit('/doacao/adicionar')
                ->click('input[value="deposito_transferencia"]')
                ->type('valor', '100.00')
                ->click('#is_anonimo[value="1"]')               
                ->attach('comprovante_anexo', __DIR__ . '/files/arquivo.pdf')
                ->press('Concluir Doação')
                ->assertSee('Doação feita com sucesso!');

        });
    }

    public function testUsuarioNaoLogadoFazerDoacaoComIdentificacao()
    {
        $doacao = Doacao::factory()->create();

        $this->browse(function (Browser $browser) {
            $browser->visit('/doacao/adicionar')
                ->click('input[value="deposito_transferencia"]')
                ->type('valor', '100.00')
                ->click('#is_identified[value="0"]')     
                ->type('nome', 'Raquel')          
                ->attach('comprovante_anexo', __DIR__ . '/files/arquivo.pdf')
                ->press('Concluir Doação')
                ->assertSee('Doação feita com sucesso!');

        });
    }

    public function testUsuarioNaoLogadoFazerDoacaoSemMeioPagamento()
    {
        $doacao = Doacao::factory()->create();

        $this->browse(function (Browser $browser) {
            $browser->visit('/doacao/adicionar')
                ->type('valor', '100.00')
                ->click('#is_identified[value="0"]')     
                ->type('nome', 'Raquel')          
                ->attach('comprovante_anexo', __DIR__ . '/files/arquivo.pdf')
                ->press('Concluir Doação')
                ->assertSee('O campo meio de pagemento deve ser preenchido');

        });
    }

    public function testUsuarioNaoLogadoFazerDoacaoSemValor()
    {
        $doacao = Doacao::factory()->create();

        $this->browse(function (Browser $browser) {
            $browser->visit('/doacao/adicionar')
                ->click('input[value="deposito_transferencia"]')
                ->click('#is_identified[value="0"]')     
                ->type('nome', 'Raquel')          
                ->attach('comprovante_anexo', __DIR__ . '/files/arquivo.pdf')
                ->press('Concluir Doação')
                ->assertSee('O campo valor precisa ser preenchido');

        });
    }


    public function testUsuarioNaoLogadoFazerDoacaoSemIdentificacao()
    {
        $doacao = Doacao::factory()->create();

        $this->browse(function (Browser $browser) {
            $browser->visit('/doacao/adicionar')
                ->click('input[value="deposito_transferencia"]')
                ->type('valor', '100.00')   
                ->type('nome', 'Raquel')          
                ->attach('comprovante_anexo', __DIR__ . '/files/arquivo.pdf')
                ->press('Concluir Doação')
                ->assertSee('O campo identificação precisa ser marcado');

        });
    }

    public function testUsuarioNaoLogadoFazerDoacaoSemComprovante()
    {
        $doacao = Doacao::factory()->create();

        $this->browse(function (Browser $browser) {
            $browser->visit('/doacao/adicionar')
                ->click('input[value="deposito_transferencia"]')
                ->type('valor', '100.00')
                ->click('#is_identified[value="0"]')     
                ->type('nome', 'Raquel')          
                ->press('Concluir Doação')
                ->assertSee('O campo comprovante anexo é obrigatório.');

        });
    }

    public function testUsuarioNaoLogadoFazerDoacaoComValorMenorQueMinimo()
    {
        $doacao = Doacao::factory()->create();

        $this->browse(function (Browser $browser) {
            $browser->visit('/doacao/adicionar')
                ->click('input[value="deposito_transferencia"]')
                ->type('valor', '1')
                ->click('#is_identified[value="0"]')     
                ->type('nome', 'Raquel')          
                ->attach('comprovante_anexo', __DIR__ . '/files/arquivo.pdf')
                ->press('Concluir Doação')
                ->assertSee('O campo valor deve conter um número superior ou igual a 5.');

        });
    }

    public function testUsuarioNaoLogadoFazerDoacaoComIdentificacaoMasSemNome()
    {
        $doacao = Doacao::factory()->create();

        $this->browse(function (Browser $browser) {
            $browser->visit('/doacao/adicionar')
                ->click('input[value="deposito_transferencia"]')
                ->type('valor', '100.00')
                ->click('#is_identified[value="0"]')              
                ->attach('comprovante_anexo', __DIR__ . '/files/arquivo.pdf')
                ->press('Concluir Doação')
                ->assertSee('O campo nome deve ser preenchido');

        });
    }

    public function testUsuarioNaoLogadoFazerDoacaoComIdentificacaoComNomeMinimo()
    {
        $doacao = Doacao::factory()->create();

        $this->browse(function (Browser $browser) {
            $browser->visit('/doacao/adicionar')
                ->click('input[value="deposito_transferencia"]')
                ->type('valor', '100.00')
                ->click('#is_identified[value="0"]')  
                ->type('nome', 'Ab')             
                ->attach('comprovante_anexo', __DIR__ . '/files/arquivo.pdf')
                ->press('Concluir Doação')
                ->assertSee('O campo de nome deve ter no mínimo 5 letras');

        });
    }

    public function testUsuarioNaoLogadoFazerDoacaoComIdentificacaoComNomeMaximo()
    {
        $doacao = Doacao::factory()->create();

        $this->browse(function (Browser $browser) {
            $browser->visit('/doacao/adicionar')
                ->click('input[value="deposito_transferencia"]')
                ->type('valor', '100.00')
                ->click('#is_identified[value="0"]')  
                ->type('nome', Str::random(257))           
                ->attach('comprovante_anexo', __DIR__ . '/files/arquivo.pdf')
                ->press('Concluir Doação')
                ->assertSee('O campo de nome não deve ter mais que 255 letras');

        });
    }
    
   
}
