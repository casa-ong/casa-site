<?php

namespace Database\Factories;

use App\Models\Despesa;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Projeto;
use Illuminate\Http\UploadedFile;

class DespesaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Despesa::class;

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
            'nota_fiscal' => UploadedFile::fake()->create('test.png', $kilobytes = 100),
            'valor' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 1000),
            'user_id' => User::factory(),
            'projeto_id' => Projeto::factory(),
            'created_at' => $this->faker->dateTimeThisYear($max = 'now', $timezone = null)
        ];
    }
}
