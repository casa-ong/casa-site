<?php

namespace Database\Factories;

use App\Models\Enquete;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnqueteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Enquete::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'texto' => $this->faker->text($maxNbChars = 200),
            'is_aberta' => $this->faker->boolean($chanceOfGettingTrue = 50),
            'user_id' => User::factory(),
        ];
    }
}
