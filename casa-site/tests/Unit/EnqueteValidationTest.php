<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Enquete;
use App\Validator\ValidationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Validator\EnqueteValidator;
use Illuminate\Support\Str;

class EnqueteValidationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testEnqueteSemTexto()
    {
        $this->expectException(ValidationException::class);

        $enquete = Enquete::factory()->make([
            'texto' => '',
        ]);

        EnqueteValidator::validate($enquete->toArray());
    }

    public function testEnqueteTextoCurto()
    {
        $this->expectException(ValidationException::class);

        $enquete = Enquete::factory()->make([
            'texto' => 'Quem você',
        ]);

        EnqueteValidator::validate($enquete->toArray());
    }

    public function testEnqueteTextoLongo()
    {
        $this->expectException(ValidationException::class);

        $enquete = Enquete::factory()->make([
            'texto' => Str::random(256),
        ]);

        EnqueteValidator::validate($enquete->toArray());
    }

    public function testEnqueteSemUser()
    {
        $this->expectException(ValidationException::class);

        $enquete = Enquete::factory()->make([
            'user_id' => '',
        ]);

        EnqueteValidator::validate($enquete->toArray());
    }

    public function testEnqueteUserInexistente()
    {
        $this->expectException(ValidationException::class);

        $enquete = Enquete::factory()->make([
            'user_id' => 0,
        ]);

        EnqueteValidator::validate($enquete->toArray());
    }

    public function testEnqueteSemOpcoes()
    {
        $this->expectException(ValidationException::class);

        $enquete = Enquete::factory()->make();
        $dados = $enquete->toArray();
        $dados['opcao'][0] = '';
        
        EnqueteValidator::validate($dados);
    }

    public function testEnqueteOpcoesCurtas()
    {
        $this->expectException(ValidationException::class);

        $enquete = Enquete::factory()->make();
        $dados = $enquete->toArray();
        $dados['opcao'][0] = 'Te';
        $dados['opcao'][1] = 'st';
        
        EnqueteValidator::validate($dados);
    }

    public function testEnqueteOpcoesLongas()
    {
        $this->expectException(ValidationException::class);

        $enquete = Enquete::factory()->make();
        $dados = $enquete->toArray();
        $dados['opcao'][0] = Str::random(256);
        $dados['opcao'][1] = Str::random(256);
        
        EnqueteValidator::validate($dados);
    }

    public function testEnqueteOpcaoAnexoEhImagem()
    {
        $this->expectException(ValidationException::class);

        $enquete = Enquete::factory()->make();
        $dados = $enquete->toArray();
        $dados['opcao'][0] = 'Opcao 1';
        $dados['opcao'][1] = 'Opcao 2';
        $dados['foto'][0] = 'anexo.pdf';
        $dados['foto'][1] = 'anexo1.pdf';
        
        EnqueteValidator::validate($dados);
    }
}
