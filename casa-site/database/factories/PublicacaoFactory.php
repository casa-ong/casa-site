<?php

namespace Database\Factories;

use App\Models\Publicacao;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class PublicacaoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Publicacao::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'descricao' =>  $this->faker->text($maxNbChars = 200),
            'anexo' => Str::random(10),
            'data' => now(),
            'publicado' => $this->faker->boolean($chanceOfGettingTrue = 50),
            'user_id'=> User::factory(),
            'hora' => now(),
            'tipo'=> "noticia",
        ];
    }
}
