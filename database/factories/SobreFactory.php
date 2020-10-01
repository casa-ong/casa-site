<?php

namespace Database\Factories;

use App\Models\Sobre;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SobreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sobre::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titulo_site' => $this->faker->name,
            'logo' =>$this->faker->imageUrl($width = 640, $height = 480),
            'texto_sobre' =>$this->faker->text($maxNbChars = 200),
            'user_id' => User::factory(),

        ];
    }
}
