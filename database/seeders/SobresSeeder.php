<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sobre;

class SobresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Sobre::factory()->create();
    }
}
