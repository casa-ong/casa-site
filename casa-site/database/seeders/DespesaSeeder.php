<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Despesa;

class DespesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Despesa::factory()->create();
       echo 'Despesa criada com sucesso!';
    }
}
