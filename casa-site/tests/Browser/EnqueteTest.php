<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Enquete;
use App\Models\Opcao;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class EnqueteTest extends DuskTestCase
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
            $browser->visit('/admin/enquete/adicionar')
                ->assertSee('Entrar');
        });
    }

    public function testUsuarioNaoLogadoAcessaFormVotar()
    {
        $enquete = Enquete::factory()
            ->hasOpcao(3)
            ->create([
                'is_aberta' => true,
            ]);

        $this->browse(function (Browser $browser) use ($enquete) {
            $browser->visit('/site/enquete/'.$enquete->id)
                ->assertSee($enquete->texto);
        });
    }

    // public function testUsuarioNaoLogadoVota()
    // {
    //     $enquete = Enquete::factory()
    //         ->hasOpcao(3)
    //         ->create([
    //             'is_aberta' => true,
    //         ]);
        
    //     $opcao = Opcao::where('enquete_id', $enquete->id)->first();

    //     $this->browse(function (Browser $browser) use ($enquete, $opcao) {
    //         $browser->visit('/site/enquete/'.$enquete->id)
    //             ->click('input[value="'.$opcao->id.'"]')
    //             ->screenshot('clicou opcao')
    //             ->assertSee($enquete->texto);
    //     });
    // }

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
                ->visit('/admin/enquete/adicionar')
                ->assertSee('Criar enquete');
        });
    }

    public function testVoluntarioLogadoEnviaFormCriar()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $this->browse(function (Browser $browser) use ($voluntario) {
            $browser->visit('/admin/enquete/adicionar')
                ->assertSee('Criar enquete')
                ->type('texto', 'Esse é uma nova enquete?');
                
            $opcaos = $browser->elements('input[name^="opcao["]');
            foreach ($opcaos as $key => $opcao) {
                $opcao->sendKeys('Opcao '.$key);
            }

            $browser->press('Salvar e publicar enquete')
                ->assertSee('Enquete criada com sucesso!');
        });
    }

    public function testVoluntarioLogadoEnviaFormCriarSemTexto()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $this->browse(function (Browser $browser) use ($voluntario) {
            $browser->visit('/admin/enquete/adicionar')
                ->assertSee('Criar enquete');
                
            $opcaos = $browser->elements('input[name^="opcao["]');
            foreach ($opcaos as $key => $opcao) {
                $opcao->sendKeys('Opcao '.$key);
            }

            $browser->press('Salvar e publicar enquete')
                ->assertSee('O campo de texto deve ser preenchido');
        });
    }

    public function testVoluntarioLogadoEnviaFormCriarTextoCurto()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $this->browse(function (Browser $browser) use ($voluntario) {
            $browser->visit('/admin/enquete/adicionar')
                ->assertSee('Criar enquete')
                ->type('texto', 'abc');
                
            $opcaos = $browser->elements('input[name^="opcao["]');
            foreach ($opcaos as $key => $opcao) {
                $opcao->sendKeys('Opcao '.$key);
            }

            $browser->press('Salvar e publicar enquete')
                ->assertSee('O campo de texto deve ter no mínimo 10 letras');
        });
    }

    public function testVoluntarioLogadoEnviaFormCriarTextoLongo()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $this->browse(function (Browser $browser) use ($voluntario) {
            $browser->visit('/admin/enquete/adicionar')
                ->assertSee('Criar enquete')
                ->type('texto', Str::random(256));
                
            $opcaos = $browser->elements('input[name^="opcao["]');
            foreach ($opcaos as $key => $opcao) {
                $opcao->sendKeys('Opcao '.$key);
            }

            $browser->press('Salvar e publicar enquete')
                ->assertSee('O campo de texto não deve ter mais que 255 letras');
        });
    }

    public function testVoluntarioLogadoEnviaFormCriarSemOpcaos()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $this->browse(function (Browser $browser) use ($voluntario) {
            $browser->visit('/admin/enquete/adicionar')
                ->assertSee('Criar enquete')
                ->type('texto', 'Consigo criar enquete sem opcoes?');

            $browser->press('Salvar e publicar enquete')
                ->assertSee('As opções não podem ser vazias');
        });
    }

    public function testVoluntarioLogadoEnviaFormCriarOpcaosCurta()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $this->browse(function (Browser $browser) use ($voluntario) {
            $browser->visit('/admin/enquete/adicionar')
                ->assertSee('Criar enquete')
                ->type('texto', 'Consigo criar enquete com texto da opcao curtas?');
                
            $opcaos = $browser->elements('input[name^="opcao["]');
            foreach ($opcaos as $key => $opcao) {
                $opcao->sendKeys($key);
            }

            $browser->press('Salvar e publicar enquete')
                ->assertSee('As opções devem ter ao menos 3 letras cada');
        });
    }

    public function testVoluntarioLogadoEnviaFormCriarFotosInvalidas()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $this->browse(function (Browser $browser) use ($voluntario) {
            $browser->visit('/admin/enquete/adicionar')
                ->assertSee('Criar enquete')
                ->type('texto', 'Consigo criar enquente com arquivos das opcaos nao imagem?');
                
            $opcaos = $browser->elements('input[name^="opcao["]');
            foreach ($opcaos as $key => $opcao) {
                $opcao->sendKeys('Opcao '.$key);
            }

            $browser->attach('input[name^="foto["]', __DIR__.'/files/arquivo.pdf');

            $browser->press('Salvar e publicar enquete')
                ->assertSee('Os arquivos das opções devem ser imagens (jpeg, png, bmp, gif, svg ou webp)');
        });
    }

    public function testVoluntarioLogadoEnviaFormCriarFotosValidas()
    {
        $voluntario = User::factory()->create([
            'admin' => true,
            'aprovado' => true,
        ]);

        $this->browse(function (Browser $browser) use ($voluntario) {
            $browser->visit('/admin/enquete/adicionar')
                ->assertSee('Criar enquete')
                ->type('texto', 'Consigo criar enquente com imagens validas?');
                
            $opcaos = $browser->elements('input[name^="opcao["]');
            foreach ($opcaos as $key => $opcao) {
                $opcao->sendKeys('Opcao '.$key);
            }

            $browser->attach('input[name^="foto["]', __DIR__.'/files/arquivo.png');

            $browser->press('Salvar e publicar enquete')
                ->assertSee('Enquete criada com sucesso!');
        });
    }
    
}
