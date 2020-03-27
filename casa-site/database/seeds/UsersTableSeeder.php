<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
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
            'telefone' => '(81)99616-9113',
            'password' => bcrypt('admin'),
            'cpf' => '111.111.111-11',
            'descricao' => 'Olá, Mundo!',
            'foto' => 'oi.png',
            'profissao' => 'Estudante',
            'admin' => '1',
        ];

        if(User::where('email', '=', $dados['email'])->count()) {
            $user = User::where('email', '=', $dados['email'])->first();
            $user->update($dados);
            echo 'Usuario alterado';
        } else {
            User::create($dados);
            echo 'Usuario criado';
        }
    }
}
