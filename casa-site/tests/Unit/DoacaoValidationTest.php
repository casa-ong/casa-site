<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Doacao;
use Illuminate\Support\Str;
use App\Validator\ValidationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Validator\DoacaoValidator;

class DoacaoValidationTest extends TestCase
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

    public function testDoacaoNomeCurto()
    {
        $this->expectException(ValidationException::class);

        $doacao = Doacao::factory()->make([
            'nome' => 'Ma',
        ]);
        DoacaoValidator::validate($doacao->toArray());
    }


    public function testDoacaoNomeLongo()
    {
        $this->expectException(ValidationException::class);

        $doacao = Doacao::factory()->make([
            'nome' => Str::random(256),
        ]);
        DoacaoValidator::validate($doacao->toArray());
    }

    public function testDoacaoSemValor()
    {
        $this->expectException(ValidationException::class);

        $doacao = Doacao::factory()->make([
            'valor' => '',
        ]);
        DoacaoValidator::validate($doacao->toArray());
    }


    public function testDoacaoValorInvalido()
    {
        $this->expectException(ValidationException::class);

        $doacao = Doacao::factory()->make([
            'valor' => 'ab',
        ]);
        DoacaoValidator::validate($doacao->toArray());
    }

    public function testDoacaoSemIsAnonimo()
    {
        $this->expectException(ValidationException::class);

        $doacao = Doacao::factory()->make([
            'is_anonimo' => null,
        ]);
        DoacaoValidator::validate($doacao->toArray());
    }

    public function testDoacaoSemMeioPagamento()
    {
        $this->expectException(ValidationException::class);

        $doacao = Doacao::factory()->make([
            'meio_pagamento' => '',
        ]);
        DoacaoValidator::validate($doacao->toArray());
    }

    public function testDoacaoSemContaPagamento()
    {
        $this->expectException(ValidationException::class);

        $doacao = Doacao::factory()->make([
            'conta_pagamento_id' => 0,
        ]);

        DoacaoValidator::validate($doacao->toArray());
    }

    public function testDoacaoSemProjeto()
    {
        $this->expectException(ValidationException::class);

        $doacao = Doacao::factory()->make([
            'projeto_id' => 0,
        ]);

        DoacaoValidator::validate($doacao->toArray());
    }
}
