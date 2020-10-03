<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Publicacao;

class PublicacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Publicacao::factory()->create();
        echo 'Publicacao criada com sucesso!';
    }
}
