<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Enquete;

class EnqueteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Enquete::factory(10)
                ->hasOpcao(3)
                ->create();
    }
}
