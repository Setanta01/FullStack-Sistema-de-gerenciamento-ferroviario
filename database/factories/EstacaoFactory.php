<?php

namespace Database\Factories;

use App\Models\Estacao;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstacaoFactory extends Factory
{
    protected $model = Estacao::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->city . ' Station',
            'cidade' => $this->faker->city,
            'codigo_postal' => $this->faker->postcode,
            'capacidade_plataformas' => $this->faker->numberBetween(1, 20),
        ];
    }
}
