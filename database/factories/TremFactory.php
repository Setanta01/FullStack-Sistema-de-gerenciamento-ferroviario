<?php

namespace Database\Factories;

use App\Models\Trem;
use Illuminate\Database\Eloquent\Factories\Factory;

class TremFactory extends Factory
{
    protected $model = Trem::class;

    public function definition()
    {
        return [
            'codigo' => strtoupper($this->faker->bothify('TRM-###')), // Exemplo: TRM-123
            'tipo' => $this->faker->randomElement(['Carga', 'Passageiros', 'Alta Velocidade']),
            'ano_fabricacao' => $this->faker->numberBetween(1990, 2023),
            'velocidade_maxima' => $this->faker->numberBetween(80, 300), // km/h
        ];
    }
}
