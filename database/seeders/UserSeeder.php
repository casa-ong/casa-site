<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dados = [
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'telefone' => '(81)99999-9999',
            'password' => bcrypt('admin'),
            'cpf' => '111.111.111-11',
            'descricao' => 'Olá, Mundo!',
            'foto' => 'oi.png',
            'profissao' => 'Estudante',
            'admin' => '1',
            'aprovado' => '1',
            'estado' => 'PE',
            'nascimento' => '1999-01-01',
        ];

        if(User::where('email', '=', $dados['email'])->count()) {
            $user = User::where('email', '=', $dados['email'])->first();
            $user->update($dados);
        } else {
            User::factory()->create($dados);
        }
    }
}
