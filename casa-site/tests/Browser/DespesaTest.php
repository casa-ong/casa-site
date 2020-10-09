<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use Illuminate\Support\Str;

class DespesaTest extends DuskTestCase
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
                ->assertSee('Quem somos');
        });
    }

    public function testUsuarioNaoLogadoAcessaFormCriar()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/despesa/adicionar')
                ->assertSee('Entrar');
        });
    }

    public function testVoluntarioAdminLogadoAcessaFormCriar()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $this->browse(function (Browser $browser) use ($voluntario) {
            $browser->visit('/login')
                ->type('email', $voluntario->email)
                ->type('password', 'password')
                ->press('Entrar')
                ->visit('/admin/despesa/adicionar')
                ->assertSee('Adicionar despesa');
        });
    }

    public function testVoluntarioLogadoEnviaFormCriar()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $this->browse(function (Browser $browser) use ($voluntario) {
            $browser->visit('/admin/despesa/adicionar')
                ->assertSee('Adicionar despesa')
                ->type('nome', 'Pagamento')
                ->type('descricao', 'Pagamento das contas')
                ->type('valor', '12');

            $browser->attach('nota_fiscal', __DIR__ . '/files/arquivo.pdf');

            $browser->press('Publicar agora')
                ->assertSee('Despesa adicionada com sucesso!');
        });
    }

     
    public function testVoluntarioLogadoEnviaFormCriarSemNome()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $this->browse(function (Browser $browser) use ($voluntario) {
            $browser->visit('/admin/despesa/adicionar')
                ->assertSee('Adicionar despesa')
                ->type('descricao', 'Pagamento das contas')
                ->type('valor', '12');
            $browser->attach('nota_fiscal', __DIR__ . '/files/arquivo.pdf');

            $browser->press('Publicar agora')
                ->assertSee('O campo nome é obrigatório.');
        });
    }

    public function testVoluntarioLogadoEnviaFormCriarNomeCurto()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $this->browse(function (Browser $browser) use ($voluntario) {
            $browser->visit('/admin/despesa/adicionar')
                ->assertSee('Adicionar despesa')
                ->type('nome', 'ab')
                ->type('descricao', 'Pagamento das contas')
                ->type('valor', '12');
            $browser->attach('nota_fiscal', __DIR__ . '/files/arquivo.pdf');

            $browser->press('Publicar agora')
                ->assertSee('O campo nome deve conter no mínimo 3 caracteres.');
        });
    }

    public function testVoluntarioLogadoEnviaFormCriarNomeLongo()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $this->browse(function (Browser $browser) use ($voluntario) {
            $browser->visit('/admin/despesa/adicionar')
                ->assertSee('Adicionar despesa')
                ->type('nome', Str::random(256))
                ->type('descricao', 'Pagamento das contas')
                ->type('valor', '12');
            $browser->attach('nota_fiscal', __DIR__ . '/files/arquivo.pdf');

            $browser->press('Publicar agora')
                ->assertSee('O campo nome não pode conter mais de 255 caracteres');
        });
    }


    public function testVoluntarioLogadoEnviaFormCriarSemDescricao()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $this->browse(function (Browser $browser) use ($voluntario) {
            $browser->visit('/admin/despesa/adicionar')
                ->assertSee('Adicionar despesa')
                ->type('nome', 'abcd')
                ->type('valor', '12');
            $browser->attach('nota_fiscal', __DIR__ . '/files/arquivo.pdf');

            $browser->press('Publicar agora')
                ->assertSee('O campo descricao é obrigatório.');
        });
    }

    public function testVoluntarioLogadoEnviaFormCriarDescricaoCurta()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $this->browse(function (Browser $browser) use ($voluntario) {
            $browser->visit('/admin/despesa/adicionar')
                ->assertSee('Adicionar despesa')
                ->type('nome', 'abcd')
                ->type('descricao', 'Pa')
                ->type('valor', '12');
            $browser->attach('nota_fiscal', __DIR__ . '/files/arquivo.pdf');

            $browser->press('Publicar agora')
                ->assertSee('O campo descricao deve conter no mínimo 3 caracteres.');
        });
    }  

    public function testVoluntarioLogadoEnviaFormCriarSemValor()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $this->browse(function (Browser $browser) use ($voluntario) {
            $browser->visit('/admin/despesa/adicionar')
                ->assertSee('Adicionar despesa')
                ->type('nome', 'abcd')
                ->type('descricao', 'Pa');
            $browser->attach('nota_fiscal', __DIR__ . '/files/arquivo.pdf');

            $browser->press('Publicar agora')
                ->assertSee('O campo valor é obrigatório.');
        });
    }

    public function testVoluntarioLogadoEnviaFormCriarValorInvalido()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $this->browse(function (Browser $browser) use ($voluntario) {
            $browser->visit('/admin/despesa/adicionar')
                ->assertSee('Adicionar despesa')
                ->type('nome', 'abcd')
                ->type('descricao', 'Pagamento')
                ->type('valor', 'abc');
            $browser->attach('nota_fiscal', __DIR__ . '/files/arquivo.pdf');

            $browser->press('Publicar agora')
                ->assertSee('O campo valor deve conter um valor numérico.');
        });
    }  

    
    public function testVoluntarioLogadoEnviaFormCriarFotosArquivosInvalidos()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $this->browse(function (Browser $browser) use ($voluntario) {
            $browser->visit('/admin/despesa/adicionar')
                ->assertSee('Adicionar despesa')
                ->type('nome', 'Consigo criar despesa com arquivos das opcaos nao imagem?')
                ->type('descricao', 'Pagamento das contas')
                ->type('valor', '12');


            $browser->attach('nota_fiscal', __DIR__.'/files/arquivoInv.pdf');

            $browser->press('Publicar agora')
                ->assertSee('O arquivo da nota fiscal deve ser uma imagem (jpeg, png, bmp, svg ou webp) ou um pdf');
        });
    }
    

    public function testVoluntarioLogadoEnviaFormCriarFotosArquivosValidos()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $this->browse(function (Browser $browser) use ($voluntario) {
            $browser->visit('/admin/despesa/adicionar')
                ->assertSee('Adicionar despesa')
                ->type('nome', 'Consigo criar despesa com imagens validas?')
                ->type('descricao', 'Pagamento das contas')
                ->type('valor', '12');
            $browser->attach('nota_fiscal', __DIR__ . '/files/arquivo.png');

            $browser->press('Publicar agora')
                ->assertSee('Despesa adicionada com sucesso!');
        });
    }
}
