<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Despesa;
use App\Validator\DespesaValidator;
use App\Validator\ValidationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class DespesaTest extends TestCase
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

    public function testDespesaSemNome()
    {
        $this->expectException(ValidationException::class);

        $despesa = Despesa::factory()->make([
            'nome' => '',
        ]);
        DespesaValidator::validate($despesa->toArray());
    }

    public function testDespesaNomePequeno()
    {
        $this->expectException(ValidationException::class);

        $despesa = Despesa::factory()->make([
            'nome' => 'ab',
        ]);
        DespesaValidator::validate($despesa->toArray());
    }

    public function testDespesaNomeGrande()
    {
        $this->expectException(ValidationException::class);

        $despesa = Despesa::factory()->make([
            'nome' => Str::random(256),
        ]);
        DespesaValidator::validate($despesa->toArray());
    }

    public function testDespesaSemDescricao(){
        $this->expectException(ValidationException::class);

        $despesa = Despesa::factory()->make([
            'descricao' => '',
        ]);
        DespesaValidator::validate($despesa->toArray());
    }

    public function testDespesaDescricaoPequena(){
        $this->expectException(ValidationException::class);

        $despesa = Despesa::factory()->make([
            'descricao' => 'ab',
        ]);
        DespesaValidator::validate($despesa->toArray());
    }

    public function testDespesaSemValor(){
        $this->expectException(ValidationException::class);

        $despesa = Despesa::factory()->make([
            'valor' => '',
        ]);
        DespesaValidator::validate($despesa->toArray());
    }

    public function testDespesaValorInvalido(){
        $this->expectException(ValidationException::class);

        $despesa = Despesa::factory()->make([
            'valor' => 'aaa',
        ]);
        DespesaValidator::validate($despesa->toArray());
    }

    public function testDespesaSemNotaFiscal()
    {
        $this->expectException(ValidationException::class);

        $user = Despesa::factory()->make([
            'nota_fiscal' => '',
        ]);
        DespesaValidator::validate($user->toArray());
    }

    public function testDespesaNotaFiscalInvalida()
    {
        $this->expectException(ValidationException::class);

        $user = Despesa::factory()->make([
            'nota_fiscal' => 'documento',
        ]);
        DespesaValidator::validate($user->toArray());
    }


}
