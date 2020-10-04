<?php

namespace Database\Factories;

use App\Models\Opcao;
use App\Models\Enquete;
use Illuminate\Database\Eloquent\Factories\Factory;

class OpcaoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Opcao::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name(),
            'foto' => null,
            'enquete_id' => Enquete::factory(),
        ];
    }
}
