<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doacao;

class DoacaosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Doacao::factory()->create();
    }
}
