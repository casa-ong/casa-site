<?php

namespace Database\Factories;

use App\Models\Sugestao;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Str;

class SugestaoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sugestao::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'assunto'=> Str::random(100),
            'mensagem' => $this->faker->text($maxNbChars = 200),
            'email'=> $this->faker->unique()->safeEmail,
            'telefone'=> Str::random(11),
            'lida' => $this->faker->boolean($chanceOfGettingTrue = 50),
            'data_leitura' => now(),
            'user_id' => User::factory(),
        ];
    }
}
