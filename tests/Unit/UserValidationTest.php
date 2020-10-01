<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Validator\ValidationException;
use App\Validator\UserValidator;
use Illuminate\Support\Str;

class UserValidationTest extends TestCase
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

    public function testUserSemNome()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->make([
            'name' => '',
        ]);
        
        UserValidator::validate($user->toArray());
    }

    public function testUserNomeCurto()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->make([
            'name' => 'Vi',
        ]);
        UserValidator::validate($user->toArray());
    }

    public function testUserNomeLongo()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->make([
            'name' => Str::random(256),
        ]);
        UserValidator::validate($user->toArray());
    }

    public function testUserSemCpf()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->make([
            'cpf' => '',
        ]);
        UserValidator::validate($user->toArray());
    }

    public function testUserCpfInvalido()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->make([
            'cpf' => '111.111.111-111',
        ]);
        UserValidator::validate($user->toArray());
    }

    public function testUserSemProfissao()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->make([
            'profissao' => '',
        ]);
        UserValidator::validate($user->toArray());
    }

    public function testUserProfissaoCurto()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->make([
            'profissao' => 'Es',
        ]);
        UserValidator::validate($user->toArray());
    }

    public function testUserProfissaoLongo()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->make([
            'profissao' => Str::random(256),
        ]);
        UserValidator::validate($user->toArray());
    }

    public function testUserSemFoto()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->make([
            'foto' => '',
        ]);
        UserValidator::validate($user->toArray());
    }

    public function testUserFotoInvalida()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->make([
            'foto' => 'documento.pdf',
        ]);
        UserValidator::validate($user->toArray());
    }

    public function testUserSemEmail()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->make([
            'email' => '',
        ]);
        UserValidator::validate($user->toArray());
    }

    public function testUserEmailInvalido()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->make([
            'email' => 'vinicius@',
        ]);
        UserValidator::validate($user->toArray());
    }

    public function testUserEmailUnico()
    {
        $this->expectException(ValidationException::class);

        User::factory()->create([
            'email' => 'vinicius@email.com',
        ]);

        $user = User::factory()->make([
            'email' => 'vinicius@email.com',
        ]);

        UserValidator::validate($user->toArray());
    }

    public function testUserEmailLongo()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->make([
            'email' => "teste@".Str::random(256).".com",
        ]);

        UserValidator::validate($user->toArray());
    }

    public function testUserTelefoneInvalido()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->make([
            'telefone' => '8199999999999999',
        ]);

        UserValidator::validate($user->toArray());
    }

    public function testUserSemEstado()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->make([
            'estado' => '',
        ]);

        UserValidator::validate($user->toArray());
    }

    public function testUserEstadoCurto()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->make([
            'estado' => 'A',
        ]);

        UserValidator::validate($user->toArray());
    }

    public function testUserEstadoLongo()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->make([
            'estado' => 'AAA',
        ]);

        UserValidator::validate($user->toArray());
    }

    public function testUserCidadeCurta()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->make([
            'cidade' => 'Sa',
        ]);

        UserValidator::validate($user->toArray());
    }

    public function testUserCidadeLonga()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->make([
            'cidade' => Str::random(51),
        ]);

        UserValidator::validate($user->toArray());
    }

    public function testUserNascimentoInvalido()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->make([
            'nascimento' => '01-1999',
        ]);

        UserValidator::validate($user->toArray());
    }

    public function testUserProjetoInexistente()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->make([
            'projeto_id' => Str::random(1),
        ]);

        UserValidator::validate($user->toArray());
    }

    // public function testUserSenhaFraca()
    // {
    //     $this->expectException(ValidationException::class);

    //     $user = User::factory()->make([
    //         'password' => '12345',
    //     ]);

    //     UserValidator::validate($user->toArray());
    // }
}
