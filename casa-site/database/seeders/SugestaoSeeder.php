<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sugestao;

class SugestaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sugestao::factory()->create();
        echo 'Sugestao criada com sucesso!';
    }
}
