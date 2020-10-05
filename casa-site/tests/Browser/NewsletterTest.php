<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Newsletter;
use Illuminate\Support\Str;

class NewsletterTest extends DuskTestCase
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

    public function testUsuarioAssinarNewsletter()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->type('email_newsletter', 'teste@teste.com')
                ->press('Cadastrar-se')
                ->assertSee('Cadastro feito com sucesso, agora você ficará sabendo das novidades!');

        });
    }

    public function testUsuarioAssinarNewsletterEmailInvalido()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->type('email_newsletter', 'teste')
                ->press('Cadastrar-se')
                ->assertSee('Endereço de email digitado inválido');

        });
    }

    public function testUsuarioEditarTipoRecebimentoEmailEventos()
    {
        $newsletter = Newsletter::factory()
            
            ->create([
                'email_newsletter' => 'teste@teste.com',
                'receber_eventos' => '1',
                'receber_projetos' => '1',
                'receber_noticias' => '1',
            ]);

        $this->browse(function (Browser $browser) use ($newsletter) {
            $browser->visit('/newsletter/editar/'.$newsletter->id.'/'.$newsletter->token)
                ->assertSee('Configurar notificações')
                ->click('input[name="receber_eventos"]')
                ->press('Salvar')
                ->assertSee('Notificações de email atualizadas com sucesso!');


        });
    }

    public function testUsuarioEditarTipoRecebimentoEmailProjetos()
    {
        $newsletter = Newsletter::factory()
            
            ->create([
                'email_newsletter' => 'teste@teste.com',
                'receber_eventos' => '1',
                'receber_projetos' => '1',
                'receber_noticias' => '1',
            ]);

        $this->browse(function (Browser $browser) use ($newsletter) {
            $browser->visit('/newsletter/editar/'.$newsletter->id.'/'.$newsletter->token)
                ->assertSee('Configurar notificações')
                ->click('input[name="receber_projetos"]')
                ->press('Salvar')
                ->assertSee('Notificações de email atualizadas com sucesso!');


        });
    }
    
    public function testUsuarioEditarTipoRecebimentoEmailNoticias()
    {
        $newsletter = Newsletter::factory()
            
            ->create([
                'email_newsletter' => 'teste@teste.com',
                'receber_eventos' => '1',
                'receber_projetos' => '1',
                'receber_noticias' => '1',
            ]);

        $this->browse(function (Browser $browser) use ($newsletter) {
            $browser->visit('/newsletter/editar/'.$newsletter->id.'/'.$newsletter->token)
                ->assertSee('Configurar notificações')
                ->click('input[name="receber_noticias"]')
                ->press('Salvar')
                ->assertSee('Notificações de email atualizadas com sucesso!');


        });
    }
    
    public function testUsuarioCancelarRecebimentoEmails()
    {
        $newsletter = Newsletter::factory()
            
            ->create([
                'email_newsletter' => 'teste@teste.com',
                'receber_eventos' => '1',
                'receber_projetos' => '1',
                'receber_noticias' => '1',
            ]);

        $this->browse(function (Browser $browser) use ($newsletter) {
            $browser->visit('/newsletter/editar/'.$newsletter->id.'/'.$newsletter->token)
                ->assertSee('Configurar notificações')
                ->click('input[name="receber_eventos"]')
                ->click('input[name="receber_projetos"]')
                ->click('input[name="receber_noticias"]')
                ->press('Salvar')
                ->assertSee('Notificações de email canceladas com sucesso!');


        });
    }

    public function testUsuarioEmailJaCadastrado()
    {
        $newsletter = Newsletter::factory()
            
            ->create([
                'email_newsletter' => 'teste@teste.com',
                'receber_eventos' => '1',
                'receber_projetos' => '1',
                'receber_noticias' => '1',
            ]);

        $this->browse(function (Browser $browser) use ($newsletter) {
            $browser->visit('/')
                ->type('email_newsletter', 'teste@teste.com')
                ->press('Cadastrar-se')
                ->assertSee('Endereço de email digitado já tem cadastro');


        });
    }

    public function testUsuarioAssinarNewsletterTamanhoDeEmailInvalido()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->type('email_newsletter', Str::random(256).'@gmail.com')
                ->press('Cadastrar-se')
                ->assertSee('O campo email newsletter não pode conter mais de 255 caracteres.');

        });
    }
   
}
