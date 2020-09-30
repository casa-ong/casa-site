<?php

namespace Database\Factories;

use App\Models\Contato;
use App\Models\Sobre;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContatoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contato::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'telefone' => $this->faker->e164PhoneNumber,
            'email'=> $this->faker->unique()->safeEmail,
            'instagram' => $this->faker->url,
            'twitter' => $this->faker->url,
            'facebook' => $this->faker->url,
            'sobre_id'=> Sobre::factory(),
        ];
    }
}
