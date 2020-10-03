<?php

namespace Database\Factories;

use App\Models\Projeto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProjetoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     * 
     */
    protected $model = Projeto::class;
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
            'publicado' => $this->faker->boolean($chanceOfGettingTrue = 50),
        ];
    }
}
