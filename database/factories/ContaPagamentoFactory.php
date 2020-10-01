<?php

namespace Database\Factories;

use App\Models\ContaPagamento;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ContaPagamentoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContaPagamento::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'cnpj' => Str::random(14),
            'banco' => $this->faker->name,
            'agencia' => $this->faker->randomNumber($nbDigits = 4),
            'operacao' => $this->faker->randomNumber($nbDigits = 3),
            'numero_conta' => $this->faker->bankAccountNumber, 
        ];
    }
}
