<?php

namespace Database\Factories;

use App\Models\Newsletter;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsletterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Newsletter::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        
        return [
            'email_newsletter' => $this->faker->unique()->safeEmail,
            'receber_eventos' => $this->faker->boolean($chanceOfGettingTrue = 50),
            'receber_projetos' => $this->faker->boolean($chanceOfGettingTrue = 50),
            'receber_noticias' => $this->faker->boolean($chanceOfGettingTrue = 50),
            'token' => Str::random(10),
            'user_id' => User::factory(),
        ];
    }
}
