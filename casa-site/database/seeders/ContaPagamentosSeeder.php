<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContaPagamento;

class ContaPagamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContaPagamento::factory()->create();
    }
}
