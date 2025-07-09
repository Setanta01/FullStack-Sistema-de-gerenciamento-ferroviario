<?php

namespace Database\Factories;

use App\Models\Maquinista;
use App\Models\Funcionario;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaquinistaFactory extends Factory
{
    protected $model = Maquinista::class;

    public function definition()
    {
        return [
            // Gera ou associa um Funcionario existente, ou cria um novo
            'funcionario_id' => Funcionario::factory(),

            'licenca' => strtoupper($this->faker->bothify('LIC-####')), // Ex: LIC-1234
            'tempo_experiencia' => $this->faker->numberBetween(1, 40), // anos de experiência
            'data_validade' => $this->faker->dateTimeBetween('now', '+20 years'),
            'categoria_licenca' => $this->faker->randomElement(['B', 'A', 'C']),
        ];
    }
}
