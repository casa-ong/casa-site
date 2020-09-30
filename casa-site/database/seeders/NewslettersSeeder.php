<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Newsletter;

class NewslettersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dados = [
            'email_newsletter' => 'teste@teste.com',
        ];

        Newsletter::factory(10)
                ->create();
        echo 'Newsletter criado com sucesso!';
    }
}
