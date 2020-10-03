<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Projeto;


class ProjetoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Projeto::factory()->create();
       echo 'Projeto criado com sucesso!';
    }
}
