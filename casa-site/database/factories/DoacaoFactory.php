<?php

namespace Database\Factories;

use App\Models\Doacao;
use App\Models\Projeto;
use App\Models\ContaPagamento;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class DoacaoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Doacao::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'valor' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 1000),
            'meio_pagamento' => $this->faker->name,
            'is_anonimo' => $this->faker->boolean,
            'is_aprovado' => $this->faker->boolean,
            'comprovante_anexo' =>$this->faker->imageUrl($width = 640, $height = 480),
            'conta_pagamento_id' => ContaPagamento::factory(),
            'created_at' => $this->faker->dateTimeThisYear($max = 'now', $timezone = null)
            // 'projeto_id' => Projeto::factory(),
            
        ];
    }
}
